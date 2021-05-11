<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CoopCompany;
use App\Models\CoopEmployee;
use Illuminate\Http\Request;
use App\Models\UserToCompany;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function index($id, Request $request)
    {
        $company = CoopCompany::where('id', $id)->first();

        if (empty($company))
            return redirect()->route('admin.deleted_company', ['id' => $id]);

        $allEmployees = User::whereBetween('job_id', [1, 7])->getQuery();

        $employees['osgbEmployees'] = UserToCompany::whereHas('user', function ($query) {
            $query->whereBetween('job_id', [1, 7]);
        })->where('company_id', $id)->get();

        if ($request->ajax()) {
            $coopEmployees = CoopEmployee::where('company_id', $id)->get();
            return DataTables::of($coopEmployees)->make(true);
        }

        return (view(
            'admin.company',
            [
                'company' => $company,
                'employees' => $employees,
                'allEmployees' => $allEmployees,
                'deleted' => false,
            ],
        ));
    }

    public function deletedIndex($id)
    {
        $company = CoopCompany::where('id', $id)->onlyTrashed()->first();
        $employees = null;

        return (view(
            'admin.company',
            [
                'company' => $company,
                'osgbEmployees' => $employees,
                'deleted' => true
            ],
        ));
    }

    public function update(CoopCompany $company, Request $request)
    {
        $updatedData = array_diff_assoc($request->toArray(), $company->toArray());
        unset($updatedData['_token']);
        try {
            $company->update($updatedData);
        } catch (\Throwable $th) {
            return redirect()->back()->with('fail', 'Değişiklerinizi uygularken bir hatayla karşılaştık!');
        }
        return redirect()->back()->with('success', 'Yaptığınız değişiklikler başarıyla uygulanmıştır!');
    }

    public function delete(CoopCompany $company)
    {
        try {
            CoopCompany::where('id', $company->id)->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('fail', 'Silme esnasında bir hatayla karşılaşıldı!');
        }
        return redirect()->route('admin.companies.index')->with('success', 'Şirket başarıyla silinmiştir. Silinen işletmelere ARŞİV bölümünden ulaşabilirsiniz!');
    }

    public function assignEmployee(CoopCompany $company, Request $request)
    {
        try {
            UserToCompany::create([
                'user_id' => $request->user,
                'company_id' => $company->id
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('fail', 'Bir hata ile karşılaşıldı!');
        }
        return redirect()->back()->with('success', 'Seçtiğiniz çalışan şirketiniz ile eşleştirildi!');
    }

    public function addEmployee(CoopCompany $company, Request $request)
    {
        $this->validate($request, [
            'calisanEmail' => 'email|unique:coop_employees,email',
            'calisanAd' => 'required',
            'calisanTc' => 'required|unique:coop_employees,tc',
            'calisanIseGirisTarihi' => 'required',

        ]);
        try {
            CoopEmployee::create([
                'name' => $request->calisanAd,
                'company_id' => $company->id,
                'email' => $request->calisanEmail,
                'tc' => $request->calisanTc,
                'recruitment_date' => $request->calisanIseGirisTarihi,
                'phone' => $request->calisanTelefon,
                'position' => $request->calisanPozisyon,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('fail', 'Bir Hata ile Karşılaşıldı!');
        }
        return redirect()->back()->with('success', 'Yeni Çalışan Başarıyla Eklendi!');
    }

    public function deleteEmployee($company, $employee, Request $request)
    {
        try {
            CoopEmployee::where('id', $employee)->where('company_id', $company)->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('fail', 'Bir hata ile karşılaşıldı!');
        }
        return redirect()->back()->with('success', 'Çalışan başarıyla silindi. Silinen çalışanlara ARŞİV bölümünden ulaşabilirsiniz');
    }
}
