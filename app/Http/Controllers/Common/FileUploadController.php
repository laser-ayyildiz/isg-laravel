<?php

namespace App\Http\Controllers\Common;

use App\Models\File;
use App\Models\CoopCompany;
use App\Models\CoopEmployee;
use Illuminate\Http\Request;
use App\Models\CompanyToFile;
use App\Models\EmployeeToFile;
use App\Models\CompanyFileType;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\EmployeeEducationType;

class FileUploadController extends Controller
{
    const EMP_FILE_NAMES = [
        '1' => 'İSG Eğitimi 1',
        '2' => 'iSG Eğitimi 2',
        '3' => 'Sağlık Muayenesi',
        '4' => 'İlk Yardım Sertifikası',
        '5' => 'Yangın Eğitim Sertifikası',
        '6' => 'Mesleki Yeterlilik Sertifikası',
        '7' => 'Hijyen Eğitim Sertifikası',
        '8' => 'Özlük Dosyası Evrakları',
        '9' => 'Yüksekte Çalışma Eğitimi',
        '10' => 'Yangın Eğitimi',
        '11' => 'Acil Durum Ekip Eğitimi',
    ];

    const COMP_FILE_NAMES = [
        '1' => 'İş Yeri Uzman Sözleşmesi',
        '2' => 'İş Yeri Hekim Sözleşmesi',
        '3' => 'Acil Durum Eylem Planı',
        '4' => 'Risk Analizi Dosyası',
        '5' => 'Yıllık Çalışma Planı',
        '6' => 'Yıllık Eğitim Programı',
        '7' => 'Dsp Sözleşmesi',
        '8' => 'Yıl Sonu Değerlendirme Raporu',
        '9' => 'Defter Nüshası',
        '10' => 'Saha Gözlem Raporu',
    ];

    public function empFileUpload(CoopEmployee $employee, Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt,xlx,xls,xlsx,odt,odf,pdf,png,jpg,jpeg,doc,docx,ppt,pptx|max:46080',
            'file_type' => ['required', Rule::in(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'])],
            'name' => 'nullable|string|max:250',
            'file_date' => 'nullable|before_or_equal:' . date('Y-m-d')
        ], [], [
            'name' => 'Dosya Adı',
            'file' => 'Dosya',
            'file_type' => 'Dosya Tipi',
            'file_date' => 'Dosya Tarihi',
        ]);

        if ($request->file_type == 12)
            if ($request->name === null)
                return back()->with(['fail' => 'Lütfen Dosyanıza bir isim verin', 'tab' => 'isletme_calisanlar']);

        /////////////////////////////////////////////////////////////////////////////////

        $period = null;

        if ($employee->company->danger_type == 1) {
            $period = EmployeeEducationType::where('id', $request->file_type)->first('validity_period_type_1')->validity_period_type_1;
        } else if ($employee->company->danger_type == 2) {
            $period = EmployeeEducationType::where('id', $request->file_type)->first('validity_period_type_2')->validity_period_type_2;
        } else if ($employee->company->danger_type == 3) {
            $period = EmployeeEducationType::where('id', $request->file_type)->first('validity_period_type_3')->validity_period_type_3;
        }

        if ($period !== null) {
            $valid_date = date('Y-m-d', strtotime("+" . $period . " months", strtotime($request->file_date ?? date('Y-m-d'))));
        }

        /////////////////////////////////////////////////////////////////////////////////

        $fileName = $request->name ?? self::EMP_FILE_NAMES[$request->file_type];
        $assigned_at = $request->file_date ?? date('Y-m-d');
        DB::beginTransaction();
        try {
            $fileModel = new File;
            $fileName = $fileName . '_' . date('Y-m-d_His') . '.' .  $request->file->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('uploads/employee-files', $fileName, 'public');

            $fileModel->name = $fileName;
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();

            /////////////////////////////////////////////////////////////////////////////////

            if ($request->file_type == '1') {
                $employee->first_edu = 1;
                $employee->save();
            } else if ($request->file_type == '2') {
                $employee->second_edu = 1;
                $employee->save();
            } else if ($request->file_type == '3') {
                $employee->examination = 1;
                $employee->save();
            }

            /////////////////////////////////////////////////////////////////////////////////

            EmployeeToFile::create([
                'file_type' => $request->file_type,
                'employee_id' => $employee->id,
                'file_id' => $fileModel->id,
                'assigned_at' => $assigned_at,
                'valid_date' => $valid_date ?? null
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with(
                [
                    'fail' => 'İşleminizi gerçekleştirirken bir hata ile karşılaşıldı.',
                    'tab' => 'files'
                ]
            );
        }
        DB::commit();
        return back()->with(
            [
                'success' => 'Dosyanız ' . $fileName . ' ismiyle başarıyla kayıt edildi.',
                'tab' => 'files'
            ]
        );
    }

    public function mandatoryFiles(CoopCompany $company, Request $request)
    {
        $request->validate(
            [
                'file' => 'required|file|mimes:csv,txt,xlx,xls,xlsx,odt,odf,mp3,mp4,pdf,png,jpg,jpeg,doc,docx,ppt,pptx|max:46080',
                'file_type' => ['required', Rule::in(['1', '2', '3', '4', '5', '6', '7', '8'])],
            ],
            [],
            [
                'file' => 'Dosya',
                'file_type' => 'Dosya Tipi'
            ]
        );
        $period = null;
        $fileName = null;

        if ($company->danger_type == 1) {
            $period = CompanyFileType::where('id', $request->file_type)->first('validity_period_type_1')->validity_period_type_1;
        } else if ($company->danger_type == 2) {
            $period = CompanyFileType::where('id', $request->file_type)->first('validity_period_type_2')->validity_period_type_2;
        } else if ($company->danger_type == 3) {
            $period = CompanyFileType::where('id', $request->file_type)->first('validity_period_type_3')->validity_period_type_3;
        }

        if ($period !== null) {
            $valid_date = date('Y-m-d', strtotime("+" . $period . " months", strtotime($request->assigned_at ?? date('Y-m-d'))));
        }
        DB::beginTransaction();
        try {
            $fileModel = new File;
            $fileName = self::COMP_FILE_NAMES[$request->file_type] . '_' . date('Y-m-d_His') . '.' . $request->file->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('uploads/company-mandatory-files', $fileName, 'public');

            $fileModel->name = $fileName;
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();
            CompanyToFile::create([
                'company_id' => $company->id,
                'file_id' => $fileModel->id,
                'file_type' => $request->file_type,
                'assigned_at' => $request->assigned_at ?? date('Y-m-d H:i:s'),
                'valid_date' => $valid_date ?? null,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with(
                [
                    'fail' => 'İşleminizi gerçekleştirirken bir hata ile karşılaşıldı.',
                    'tab' => 'isletme_rapor'
                ]
            );
        }
        DB::commit();
        return back()->with(
            [
                'success' => 'Dosyanız ' . $fileName . ' ismiyle başarıyla kayıt edildi.',
                'tab' => 'isletme_rapor'
            ]
        );
    }

    public function empBatchFileUpload(CoopCompany $company, Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt,xlx,xls,xlsx,odt,odf,pdf,png,jpg,jpeg,doc,docx,ppt,pptx|max:46080',
            'name' => 'nullable|string|max:250',
            'batch_file_type' => ['required', Rule::in(['1', '2', '9', '10', '11', '12'])],
            'file_date' => 'nullable|before_or_equal:' . date('Y-m-d')
        ], [], [
            'name' => 'Dosya Adı',
            'file' => 'Dosya',
            'batch_file_type' => 'Dosya Tipi',
            'file_date' => 'Dosya Tarihi'
        ]);

        if ($request->batch_file_type == 12)
            if ($request->name === null)
                return back()->with(['fail' => 'Lütfen Dosyanıza bir isim verin', 'tab' => 'isletme_calisanlar']);

        /////////////////////////////////////////////////////////////////////////////////

        $period = null;
        if ($company->danger_type == 1) {
            $period = EmployeeEducationType::where('id', $request->batch_file_type)->first('validity_period_type_1')->validity_period_type_1;
        } else if ($company->danger_type == 2) {
            $period = EmployeeEducationType::where('id', $request->batch_file_type)->first('validity_period_type_2')->validity_period_type_2;
        } else if ($company->danger_type == 3) {
            $period = EmployeeEducationType::where('id', $request->batch_file_type)->first('validity_period_type_3')->validity_period_type_3;
        }

        if ($period !== null) {
            $valid_date = date('Y-m-d', strtotime("+" . $period . " months", strtotime($request->assigned_at ?? date('Y-m-d'))));
        }

        /////////////////////////////////////////////////////////////////////////////////

        $fileName = $request->name ?? self::EMP_FILE_NAMES[$request->batch_file_type];
        $employeeIds = [];
        $assigned_at = $request->file_date ?? date('Y-m-d');

        if ($request->has('selectAll')) {
            $employeeIds = CoopEmployee::where('company_id', $company->id)->pluck('id')->toArray();
        } else {
            foreach ($request->toArray() as $key => $value) {
                if (preg_match('/^box/', $key)) {
                    $employeeIds[] = intval($value);
                }
            }
        }

        if (count($employeeIds) === 0)
            return back()->with(['tab' => 'isletme_calisanlar', 'fail' => 'İşletmeye ait aktif çalışan bulunamadı veya hiçbir çalışan seçilmedi!']);

        /////////////////////////////////////////////////////////////////////////////////

        DB::beginTransaction();
        try {
            $fileModel = new File;
            $fileName = $fileName . '_' . date('Y-m-d_His') . '.' .  $request->file->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('uploads/employee-files', $fileName, 'public');
            $fileModel->name = $fileName;
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();

            /////////////////////////////////////////////////////////////////
            $employeeToFiles = null;
            if ($request->batch_file_type == '1') {
                foreach ($employeeIds as $id) {
                    $employee = CoopEmployee::find($id);
                    $employee->first_edu = 1;
                    $employee->save();
                }
            } else if ($request->batch_file_type == '2') {
                foreach ($employeeIds as $id) {
                    $employee = CoopEmployee::find($id);
                    $employee->second_edu = 1;
                    $employee->save();
                }
            }
            foreach ($employeeIds as $id) {
                $employeeToFiles[] = [
                    'file_type' => $request->batch_file_type,
                    'employee_id' => $id,
                    'file_id' => $fileModel->id,
                    'assigned_at' => $assigned_at,
                    'valid_date' => $valid_date ?? null,
                ];
            }
            if ($employeeToFiles !== null)
                EmployeeToFile::insert($employeeToFiles);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return back()->with(
                [
                    'fail' => 'İşleminizi gerçekleştirirken bir hata ile karşılaşıldı.',
                    'tab' => 'isletme_calisanlar'
                ]
            );
        }
        DB::commit();
        return back()->with(
            [
                'success' => 'Dosyanız ' . $fileName . ' ismiyle başarıyla kayıt edildi.',
                'tab' => 'isletme_calisanlar'
            ]
        );
    }

    public function monthlyFilesUpload(CoopCompany $company, Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt,xlx,xls,xlsx,odt,odf,pdf,png,jpg,jpeg,doc,docx,ppt,pptx|max:46080',
            'file_type' => ['required', Rule::in(['9', '10'])],
            'assigned_at' => 'nullable|before_or_equal:' . date('Y-m-d'),
        ], [], [
            'file' => 'Dosya',
            'file_type' => 'Dosya Tipi',
            'assigned_at' => 'Dosya Tarihi,'
        ]);
        $assigned_at = $request->assigned_at ?? date('Y-m-d');

        DB::beginTransaction();
        try {
            $fileName = self::COMP_FILE_NAMES[$request->file_type] . '_' . date('m') . time() . '.' .  $request->file->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('uploads/monthly-files', $fileName, 'public');

            $fileModel = new File;
            $fileModel->name = $fileName;
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();

            /////////////////////////////////////////////////////////////////////////////////

            CompanyToFile::create([
                'file_type' => $request->file_type,
                'company_id' => $company->id,
                'file_id' => $fileModel->id,
                'assigned_at' => $assigned_at,
                'valid_date' => date('Y-m-d', strtotime("+1 months", strtotime($assigned_at))),
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return back()->with(
                [
                    'fail' => 'İşleminizi gerçekleştirirken bir hata ile karşılaşıldı.',
                    'tab' => 'files'
                ]
            );
        }
        DB::commit();
        return back()->with(
            [
                'success' => 'Dosyanız ' . $fileName . ' ismiyle başarıyla kayıt edildi.',
                'tab' => 'files'
            ]
        );
    }
}
