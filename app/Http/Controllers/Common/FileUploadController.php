<?php

namespace App\Http\Controllers\Common;

use App\Models\File;
use App\Models\CoopCompany;
use App\Models\CoopEmployee;
use Illuminate\Http\Request;
use App\Models\CompanyToFile;
use App\Models\EmployeeToFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function empFileUpload(CoopEmployee $employee, Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,xlsx,odt,odf,mp3,mp4,pdf,png,jpg,jpeg,doc,docx,ppt,pptx|max:51200'
        ]);
        $fileName = null;

        try {
            if ($request->file()) {
                $fileModel = new File;
                $fileName = time() . '_' . $request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads/employee-files', $fileName, 'public');

                $fileModel->name = time() . '_' . $request->file->getClientOriginalName();
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->save();
                EmployeeToFile::create([
                    'employee_id' => $employee->id,
                    'file_id' => $fileModel->id
                ]);
            }
        } catch (\Throwable $th) {
            return back()->with(
                [
                    'fail' => 'İşleminizi gerçekleştirirken bir hata ile karşılaşıldı.',
                    'tab' => 'files'
                ]
            );
        }
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
        $fileName = null;

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
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with(
                [
                    'fail' => 'İşleminizi gerçekleştirirken bir hata ile karşılaşıldı.',
                    'tab' => 'isletme_rapor'
                ]
            );
        }
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
            'file_date' => 'nullable|before_or_equal:' . date('Y-m-d')
        ],[],[
            'name' => 'Dosya Adı',
            'file' => 'Dosya',
            'file_date' => 'Dosya Tarihi'
        ]);

        $fileName = $request->name;
        $employeeIds = [];
        $signed_at = $request->file_date ?? date('Y-m-d');
        
        if ($request->has('selectAll')) {
            $employeeIds = CoopEmployee::where('company_id', $company->id)->pluck('id')->toArray();
        }
        else {
            foreach ($request->toArray() as $key => $value) {
                if (preg_match('/^box/',$key)) {
                    $employeeIds[] = intval($value);
                }
            }
        }

        if (count($employeeIds) === 0)
            return back()->with(['tab' => 'isletme_calisanlar', 'fail' => 'İşletmeye ait aktif çalışan bulunamadı veya hiçbir çalışan seçilmedi!']);

        try {
            if ($request->file()) {
                $fileModel = new File;
                $fileName = time() . '_' . $request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads/employee-files', $fileName, 'public');

                $fileModel->name = time() . '_' . $request->file->getClientOriginalName();
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->save();

                /////////////////////////////////////////////////////////////////
                $employeeToFiles = null;
                foreach ($employeeIds as $id) {
                    $employeeToFiles[] = [
                        'employee_id' => $id,
                        'file_id' => $fileModel->id,
                        'signed_at' => $signed_at
                    ];
                }
                if ($employeeToFiles !== null)
                    EmployeeToFile::insert($employeeToFiles);
            }
        } catch (\Throwable $th) {
            return back()->with(
                [
                    'fail' => 'İşleminizi gerçekleştirirken bir hata ile karşılaşıldı.',
                    'tab' => 'isletme_calisanlar'
                ]
            );
        }
        return back()->with(
            [
                'success' => 'Dosyanız ' . $fileName . ' ismiyle başarıyla kayıt edildi.',
                'tab' => 'isletme_calisanlar'
            ]
        );
    }
}
