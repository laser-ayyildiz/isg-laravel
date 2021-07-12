<?php

namespace App\Http\Controllers\Common;

use App\Models\File;
use App\Models\Equipment;
use App\Models\CoopCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEquipmentRequest;
use App\Models\EquipmentToFile;

class EquipmentController extends Controller
{
    public function add(CoopCompany $company, StoreEquipmentRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $maintained_at = $request->maintained_at;
            if (empty($maintained_at))
                $maintained_at = date('Y-m-d');
            $valid_date = date('Y-m-d', strtotime("+" . $request->period . " months", strtotime($maintained_at)));

            if ($request->file('file') !== null) {

                $fileName = $request->name . '_' . date('Y-m-d_His') . '.' .  $request->file->getClientOriginalExtension();
                $filePath = $request->file('file')->storeAs('uploads/equipment-files', $fileName, 'public');

                $file = File::create(
                    [
                        'name' => $fileName,
                        'file_path' => '/storage/' . $filePath,
                    ]
                );
            }

            $equipment = Equipment::create(
                [
                    'company_id' => $company->id,
                    'name' => $request->name,
                    'period' => $request->period,
                    'file_id' => $file->id ?? null,
                    'maintained_at' => $maintained_at,
                    'valid_date' => $valid_date
                ]
            );

            if (isset($file)) {
                EquipmentToFile::create(
                    [
                        'equipment_id' => $equipment->id,
                        'file_id' => $file->id,
                    ]
                );
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return back()->with('fail', 'İşleminizi gerçekleştirirken bir hata ile karşılaşıldı.');
        }
        DB::commit();
        return back()->with(
            [
                'success' => $request->name . ' ekipmanı başarıyla kayıt edildi.',
                'tab' => 'isletme_calisanlar'
            ]
        );
    }

    public function addFile(Request $request)
    {
        $request->validate(
            [
                'maintained_at' => 'nullable|before_or_equal:' . date('Y-m-d'),
                'equipment' => 'required|exists:equipment,id',
                'file' => 'nullable|file|mimes:csv,txt,xlx,xls,xlsx,odt,odf,pdf,png,jpg,jpeg,doc,docx,ppt,pptx|max:25000',
            ],
            [],
            [
                'maintained_at' => 'Bakım Tarihi',
                'equipment' => 'Ekipman',
                'file' => 'Dosya'
            ]
        );
        DB::beginTransaction();
        try {
            $equipment = Equipment::findOrFail($request->equipment);

            $fileName = $equipment->name . '_' . date('Y-m-d_His') . '.' .  $request->file->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('uploads/equipment-files', $fileName, 'public');

            $file = File::create(
                [
                    'name' => $fileName,
                    'file_path' => '/storage/' . $filePath,
                ]
            );

            $equipment->update(
                [
                    'file_id' => $file->id,
                    'maintained_at' => $request->maintained_at ?? date('Y-m-d'),
                    'valid_date' => date('Y-m-d', strtotime("+" . $equipment->period . " months", strtotime($request->maintained_at ?? date('Y-m-d'))))
                ]
            );

            EquipmentToFile::create(
                [
                    'equipment_id' => $equipment->id,
                    'file_id' => $file->id
                ]
            );
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('fail', 'Dosya yüklenirken bir hata ile karşılaşıldı');
        }
        DB::commit();
        return back()->with(
            [
                'success' => $file->name . ' dosyası ' . $equipment->name . ' ekipmanı için başarıyla eklendi.',
            ]
        );
    }

    public function delete(Equipment $equipment)
    {
        if ($equipment === null)
            return back()->with('fail', 'Ekipman bulunamadı!');

        DB::beginTransaction();
        try {
            $equipment->delete();
            File::where('id', $equipment->file_id)->delete();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
            return back()->with('fail', 'Ekipman silinirken bir hata ile karşılaşıldı');
        }
        DB::commit();
        return back()->with(
            [
                'success' => $equipment->name . ' ekipmanı başarıyla silindi.',
            ]
        );
    }

    public function deleteFile(File $file)
    {
        if ($file === null)
            return back()->with('fail', 'Dosya bulunamadı!');
        DB::beginTransaction();
        try {
            $file->delete();
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('fail', 'Bir hata ile karşılaşıldı!');
        }

        DB::commit();
        return back()->with('success', 'Dosya başarıyla silindi');
    }
}
