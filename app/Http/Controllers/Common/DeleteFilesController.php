<?php

namespace App\Http\Controllers\Common;

use App\Models\File;
use App\Models\CoopEmployee;
use App\Models\CompanyToFile;
use App\Models\EmployeeToFile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DeleteFilesController extends Controller
{
    public function deleteEmpFile(File $file)
    {

        $types = [
            1 => 'first_edu',
            2 => 'second_edu',
            3 => 'examination'
        ];
        DB::beginTransaction();
        try {
            $file->delete();
            $empToFile = EmployeeToFile::where('file_id', $file->id)->with('employee')->first();
            if (in_array($empToFile->file_type, [1, 2, 3])) {
                $isValid = false;
                $sameFiles = EmployeeToFile::where('file_type', $empToFile->file_type)->where('file_id','!=' ,$file->id)->where('employee_id', $empToFile->employee->id)->get();

                if ($sameFiles->count() < 1) {
                    CoopEmployee::where('id', $empToFile->employee->id)->update([$types[$empToFile->file_type] => 0]);
                } else {
                    foreach ($sameFiles as $sameFile) {
                        if ($sameFile->valid_date > date('Y-m-d')) {
                            $isValid = true;
                            break;
                        }
                    }
                    if (!$isValid) {
                        CoopEmployee::where('id', $empToFile->employee->id)->update([$types[$empToFile->file_type] => 0]);
                    }
                }
            }
            $empToFile->delete();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with([
                'fail' => 'Bir hata ile karşılaşıldı!'
            ]);
        }
        DB::commit();
        return back()->with([
            'success' => 'Dosya Silindi!'
        ]);
    }

    public function deleteMandatoryFile(CompanyToFile $file)
    {
        $type = $file->type->file_name;
        DB::beginTransaction();
        try {
            File::find($file->file_id)->delete();
            $file->delete();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('fail', 'Bir Hata ile karşılaşıldı!');
        }
        DB::commit();

        return back()->with('success', $type . ' türündeki belge başarıyla silindi!');
    }

    public function deleteFile($type = null, $file = null)
    {
        DB::beginTransaction();
        try {
            File::where('id', $file)->delete();
            if ($type === 'CompanyToFile') {
                CompanyToFile::where('file_id', $file)->delete();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with([
                'tab' => 'isletme_rapor',
                'fail' => 'Bir hata ile karşılaşıldı!'
            ]);
        }
        DB::commit();

        return redirect()->back()
            ->with(
                [
                    'tab' => 'isletme_rapor',
                    'success' =>
                    "Dosya silindi. Silinen dosyalara tekrar ulaşabilmek için lütfen sistem yöneticiniz ile iletşime geçin."
                        . "<p><a href='mailto:destek@ozgurosgb.com.tr'>destek@ozgurosgb.com.tr</a></p>"
                ]

            );
    }
}
