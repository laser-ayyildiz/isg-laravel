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

            $equipment = Equipment::create(
                [
                    'company_id' => $company->id,
                    'name' => $request->name,
                    'period' => $request->period,
                    'maintained_at' => $maintained_at,
                    'valid_date' => $valid_date
                ]
            );

            if ($request->file('file') !== null) {
                $fileModel = new File;
                $fileName = $request->name . '_' . date('Y-m-d_His') . '.' .  $request->file->getClientOriginalExtension();
                $filePath = $request->file('file')->storeAs('uploads/equipment-files', $fileName, 'public');
                $fileModel->name = $fileName;
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->save();

                EquipmentToFile::create(
                    [
                        'equipment_id' => $equipment->id,
                        'file_id' => $fileModel->id,
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

    public function addFile(Equipment $equipment, Request $request)
    {
        $request->validate(
            [
                'maintained_at' => 'nullable|before_or_equal:' . date('Y-m-d'),
                'file' => 'nullable|file|mimes:csv,txt,xlx,xls,xlsx,odt,odf,pdf,png,jpg,jpeg,doc,docx,ppt,pptx|max:25000',
            ],
            [],
            [
                'maintained_at' => 'Bakım Tarihi',
                'file' => 'Dosya'
            ]
        );
        DB::beginTransaction();
        try {
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

    public function delete(Equipment $equipment, Request $request)
    {
        if ($equipment == null)
            return back()->with('fail', 'Bir hata ile karşılaşıldı');

        DB::beginTransaction();
        try {
            Equipment::where('id', $equipment->id)->delete();
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

    public function deleteFile(EquipmentToFile $equipmentToFile)
    {
        # code...
    }
}
