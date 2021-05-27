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
            return back()->with(
                [
                    'fail' => 'Bir hata ile karşılaşıldı. Lütfen excel tablonuzu kontrol edin!',
                    'tab' => 'isletme_calisanlar'
                ]
            );
        }
        return back()->with(
            [
                'success' => 'Çalışanlar başarıyla güncellendi. Yanlış bilgiler bulunan satırlar eklenmedi.' .
                    '<li>Tekrarlanan TC kimlik numaralı veya tekrarlanan email adresli kullanıcılar eklenmedi.</li>' .
                    '<li>T.C Kimlik Numarası 11 hane olmayan kullanıcılar eklenmedi.</li>' .
                    '<li>Hata olduğunu düşünüyorsanız lütfen öncelikle excel tablonuzu kontrol ediniz!</li>',
                'tab' => 'isletme_calisanlar'
            ]
        );
    }
}
