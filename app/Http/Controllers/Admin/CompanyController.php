<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CoopCompany;
use Illuminate\Http\Request;
use App\Models\UserToCompany;
use App\Http\Controllers\Controller;


class CompanyController extends Controller
{
    public function index($id)
    {
        $company = CoopCompany::where('id', $id)->first();

        if (!isset($company->name)) {
            return redirect()->route('admin.deleted_company', ['id' => $id]);
        }
        $allEmployees = User::whereBetween('job_id', [1, 7])->getQuery();

        $employees['osgbEmployees'] = UserToCompany::whereHas('user', function ($query) {
            $query->whereBetween('job_id', [1, 7]);
        })->where('company_id', $id)->get();

        $employees['coopEmployees'] = UserToCompany::whereHas('user', function ($query) {
            $query->where('job_id', 8);
        })->where('company_id', $id)->get();

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
            return redirect()->back()->with('updateFail', 'Değişiklerinizi uygularken bir hatayla karşılaştık!');
        }
        return redirect()->back()->with('updateSuccess', 'Yaptığınız değişiklikler başarıyla uygulanmıştır!');
    }

    public function delete(CoopCompany $company)
    {
        try {
            CoopCompany::where('id', $company->id)->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('deleteFail', 'Silme esnasında bir hatayla karşılaşıldı!');
        }
        return redirect()->route('admin.companies.index')->with('status', 'Şirket başarıyla silinmiştir. Silinen işletmelere ARŞİV bölümünden ulaşabilirsiniz!');
    }

    public function assignEmployee(CoopCompany $company, Request $request)
    {
        try {
            UserToCompany::create([
                'user_id' => $request->user,
                'company_id' => $company->id
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('assignEmployeeFail', 'Bir hata ile karşılaşıldı!');
        }
        return redirect()->back()->with('assignEmployeeSuccess', 'Seçtiğiniz çalışan şirketiniz ile eşleştirildi!');
    }
}
