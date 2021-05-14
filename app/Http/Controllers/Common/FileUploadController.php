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
            return redirect()->back()
                ->with('fail', 'İşleminizi gerçekleştirirken bir hata ile karşılaşıldı.');
        }
        return redirect()->back()->with(['tab' => 'files'])
            ->with('success', 'Dosyanız ' . $fileName . ' ismiyle başarıyla kayıt edildi.');
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
            throw $th;
            return redirect()->back()
                ->with('fail', 'İşleminizi gerçekleştirirken bir hata ile karşılaşıldı.');
        }
        return redirect()->back()->with(['tab' => 'files'])
            ->with('success', 'Dosyanız ' . $fileName . ' ismiyle başarıyla kayıt edildi.');
    }
}
