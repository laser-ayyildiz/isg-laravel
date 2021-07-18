<?php

namespace App\Http\Controllers\Common;

use App\Models\File;
use App\Models\CoopCompany;
use Illuminate\Http\Request;
use App\Models\EmployeeGroup;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EmployeeGroupController extends Controller
{
    const GROUP_NAMES = [
        '1' => 'İSG Görevlendirmesi',
        '2' => 'İSG Görevlendirmesi',
        '3' => 'İşveren',
        '4' => 'Çalışan Temsilcisi',
        'Ekipler Şefi' => 'Acil Durum Ekibi',
        'Arama, Kurtarma, Tahliye Ekibi' => 'Acil Durum Ekibi',
        'Yangın Söndürme Ekibi' => 'Acil Durum Ekibi',
        'İlk Yardım Ekibi' => 'Acil Durum Ekibi',
        'Destek Elemanı' => 'Risk Değerlendirme Ekibi'
    ];

    const EMPLOYEE_GROUPS = [
        '4',
        'Ekipler Şefi',
        'Arama, Kurtarma, Tahliye Ekibi',
        'Yangın Söndürme Ekibi',
        'İlk Yardım Ekibi',
        'Destek Elemanı'
    ];

    const SUB_GROUPS = [
        'Ekipler Şefi',
        'Arama, Kurtarma, Tahliye Ekibi',
        'Yangın Söndürme Ekibi',
        'İlk Yardım Ekibi',
        'Destek Elemanı',
    ];

    public function add(CoopCompany $company, Request $request)
    {
        if ($request->employee_type !== "3" && (!isset($request->employee) || empty($request->employee)))
            return back()->with('fail', 'Lütfen Bir Çalışan Seçiniz!');

        $request->validate([
            'employee_type' => 'required',
            'file' => 'nullable|file|mimes:csv,txt,xlx,xls,xlsx,odt,odf,pdf,png,jpg,jpeg,doc,docx,ppt,pptx|max:46080',
        ], [], [
            'employee_type' => 'Çalışan Tipi',
            'file' => 'Atama Dosyası'
        ]);

        $demand = [
            'company_id' => $company->id,
            'employee_id' => null,
            'isveren' => null,
            'assignment_file_id' => null,
            'osgb_employee_id' => null,
            'group' => self::GROUP_NAMES[$request->employee_type],
            'sub_group' => null,
        ];

        if (in_array($request->employee_type, ["1", "2"])) {
            $relation = EmployeeGroup::where('osgb_employee_id', $request->employee)
                ->where('group', 'İSG Görevlendirmesi')
                ->where('company_id', $company->id)
                ->count();
            if ($relation >= 1)
                return back()->with('fail', 'Atama zaten yapılmış!');

            $demand['osgb_employee_id'] = $request->employee;
        } else if (in_array($request->employee_type, self::EMPLOYEE_GROUPS)) {
            if (in_array($request->employee_type, self::SUB_GROUPS))
                $demand['sub_group'] = $request->employee_type;

            $demand['employee_id'] = $request->employee;
        } else if ($request->employee_type === "3") {
            if ($request->isveren === null)
                return back()->with('fail', 'Lütfen İşveren/Vekili için bir isim giriniz!');
            $demand['isveren'] = $request->isveren;
        } else {
            return back()->with('fail', 'Lütfen Çalışan Tipini Seçiniz!');
        }

        DB::beginTransaction();
        if (isset($request->file) && !empty($request->file)) {
            try {
                $fileModel = new File;
                $fileModel->name = $company->id . '_' . $request->employee . '_' . $demand['sub_group'] ?? self::GROUP_NAMES[$request->employee_type] . '_' . date('Y-m-d_His') . '.' .  $request->file->getClientOriginalExtension();
                $filePath = $request->file('file')->storeAs('uploads/assignment-files', $fileModel->name, 'public');

                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->save();

                $demand['assignment_file_id'] = $fileModel->id ?? null;
            } catch (\Throwable $th) {
                DB::rollback();
                return back()->with('fail', 'Dosya Yüklenirken bir Hata ile karşılaşıldı');
            }
        }

        try {
            $new = EmployeeGroup::create($demand);
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('fail', 'Gruba Ekleme Yapılırken bir Hata ile karşılaşıldı');
        }

        DB::commit();
        return back()->with('success', $new->group . ' ataması başarıyla yapıldı!');
    }

    public function addFile(CoopCompany $company, $row_id, Request $request)
    {
        $request->validate([
            'file' => 'nullable|file|mimes:csv,txt,xlx,xls,xlsx,odt,odf,pdf,png,jpg,jpeg,doc,docx,ppt,pptx|max:46080',
        ], [], [
            'file' => 'Atama Dosyası',
        ]);

        $empGroup = EmployeeGroup::find($row_id);
        if (empty($empGroup))
            return back()->with('fail', 'İlişkilendirme başarısız lütfen tekrar deneyiniz!');

        $emp_id = $empGroup->employee_id ?? $empGroup->osgb_employee_id ?? $empGroup->isveren ?? null;
        if (empty($emp_id))
            return back()->with('fail', 'İlişkilendirme başarısız lütfen tekrar deneyiniz!');

        DB::beginTransaction();
        try {
            $fileModel = new File;
            $fileModel->name = $company->id . '_' . $emp_id . '_' . $empGroup->group . '_' . date('Y-m-d_His') . '.' .  $request->file->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('uploads/assignment-files', $fileModel->name, 'public');

            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();

            $empGroup->update(['assignment_file_id' => $fileModel->id]);
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('fail', 'Dosya yüklenirken bir hata ile karşılaşıldı');
        }
        DB::commit();
        return back()->with('success', 'Atama Dosyası Başarıyla Yüklendi');
    }

    public function deleteFile(CoopCompany $company, $row_id, Request $request)
    {
        $empGroup = EmployeeGroup::find($row_id);
        if (empty($empGroup))
            return back()->with('fail', 'İlişkilendirme başarısız lütfen tekrar deneyiniz!');

        if ($company->id !== $empGroup->company_id)
            return back()->with('fail', 'Bi şeylerle mi oynadın ya sen naptın :)');

        DB::beginTransaction();
        try {
            File::where('id', $empGroup->assignment_file_id)->delete();
            $empGroup->update(['assignment_file_id' => null]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('fail', 'Dosya Silinirken bir Hata ile Karşılaşıldı!');
        }

        DB::commit();
        return back()->with('success', 'Dosya Başarıyla Silindi!');
    }
}
