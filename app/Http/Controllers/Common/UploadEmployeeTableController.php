<?php

namespace App\Http\Controllers\Common;

use App\Models\CoopCompany;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadEmployeeTableController extends Controller
{
    public function store(Request $request, CoopCompany $company)
    {
        try {
            $file = $request->file('employee-list');
            $file_name =  time() . "_" . $company->name . "." . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads/company-employee-lists', $file_name);
            $import = new UsersImport($company->id);
            $import->import($file);

            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('fail', 'Bir hata ile karşılaşıldı. Lütfen excel tablonuzu kontrol edin!');
        }
        return redirect()->back()->with('success', 'Çalışanlar başarıyla güncellendi. Yanlış bilgiler bulunan satırlar es geçildi. Tekrarlanan TC kimlik numaralı veya tekrarlanan email adresli kullanıcılar es geçildi. Hata olduğunu düşünüyorsanız lütfen öncelikle excel tablonuzu kontrol ediniz!');
    }
}
