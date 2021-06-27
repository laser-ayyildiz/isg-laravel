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
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function empFileUpload(CoopEmployee $employee, Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,xlsx,odt,odf,pdf,png,jpg,jpeg,doc,docx,ppt,pptx|max:51200',
            'file_type' => 'required|between:0,9',
            'name' => 'required|string|max:250',
            'file_date' => 'nullable|before_or_equal:' . date('Y-m-d')
        ], [], [
            'name' => 'Dosya Adı',
            'file' => 'Dosya',
            'file_type' => 'Dosya Tipi',
            'file_date' => 'Dosya Tarihi',
        ]);
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

        $fileName = $request->name;
        $signed_at = $request->file_date ?? date('Y-m-d');
        DB::beginTransaction();
        try {
            if ($request->file()) {
                $fileModel = new File;
                $fileName = $fileName . '_' . time() . '.' .  $request->file->getClientOriginalExtension();
                $filePath = $request->file('file')->storeAs('uploads/employee-files', $fileName, 'public');

                $fileModel->name = $fileName;
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->signed_at = $signed_at;
                $fileModel->save();
                if ($request->file_type == '1') {
                    $employee->first_edu = 1;
                    $employee->save();
                } else if($request->file_type == '2'){
                    $employee->second_edu = 1;
                    $employee->save();
                } else if($request->file_type == '3'){
                    $employee->examination = 1;
                    $employee->save();
                }
                EmployeeToFile::create([
                    'file_type' => $request->file_type,
                    'employee_id' => $employee->id,
                    'file_id' => $fileModel->id,
                    'valid_date' => $valid_date ?? null
                ]);
            }
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
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,xlsx,odt,odf,mp3,mp4,pdf,png,jpg,jpeg,doc,docx,ppt,pptx|max:51200',
            'file_type' => 'required|between:0,7',
        ]);
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
            if ($request->file()) {
                $fileModel = new File;
                $fileName = time() . '_' . $company->name . '_' . $request->file_type . '.' . $request->file->getClientOriginalExtension();
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
            }
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
            'file' => 'required|mimes:csv,txt,xlx,xls,xlsx,odt,odf,pdf,png,jpg,jpeg,doc,docx,ppt,pptx|max:51200',
            'name' => 'required|string|max:250',
            'batch_file_type' => ['required', Rule::in(['1', '2', '9', '10', '11'])],
            'file_date' => 'nullable|before_or_equal:' . date('Y-m-d')
        ], [], [
            'name' => 'Dosya Adı',
            'file' => 'Dosya',
            'batch_file_type' => 'Dosya Tipi',
            'file_date' => 'Dosya Tarihi'
        ]);
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

        $fileName = $request->name;
        $employeeIds = [];
        $signed_at = $request->file_date ?? date('Y-m-d');

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
        DB::beginTransaction();
        try {
            if ($request->file()) {
                $fileModel = new File;
                $fileName = $fileName . '_' . time() . '.' .  $request->file->getClientOriginalExtension();
                $filePath = $request->file('file')->storeAs('uploads/employee-files', $fileName, 'public');

                $fileModel->name = $fileName;
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->signed_at = $signed_at;
                $fileModel->save();

                /////////////////////////////////////////////////////////////////
                $employeeToFiles = null;
                if ($request->batch_file_type == '1') {
                    foreach ($employeeIds as $id) {
                        $employee = CoopEmployee::find($id);
                        $employee->first_edu = 1;
                        $employee->save();
                    }
                } else if($request->batch_file_type == '2'){
                    foreach ($employeeIds as $id) {
                        $employee = CoopEmployee::find($id);
                        $employee->second_edu = 1;
                        $employee->save();
                    }
                }
                foreach ($employeeIds as $id) {
                    $employeeToFiles[] = [
                        'file_type' => $request->file_type,
                        'employee_id' => $id,
                        'file_id' => $fileModel->id,
                        'valid_date' => $valid_date ?? null,
                    ];
                }
                if ($employeeToFiles !== null)
                    EmployeeToFile::insert($employeeToFiles);
            }
        } catch (\Throwable $th) {
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

    public function deleteMandatoryFiles(CompanyToFile $file)
    {
        $type = $file->type->file_name;
        DB::beginTransaction();
        try {
            File::find($file->file_id)->delete();
            $file->delete();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return back()->with('fail', 'Bir Hata ile karşılaşıldı!');
        }
        DB::commit();

        return back()->with('success', $type . ' türündeki belge başarıyla silindi!');
        
    }
}
