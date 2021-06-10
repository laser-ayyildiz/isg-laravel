<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CoopCompany;
use App\Models\CoopEmployee;
use Illuminate\Http\Request;
use App\Models\CompanyToFile;
use App\Models\OutAccountant;
use App\Models\UserToCompany;
use App\Models\FrontAccountant;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountantRequest;
use App\Http\Requests\StoreCoopEmployeeRequest;

class CompanyController extends Controller
{
    public function index($id)
    {
        $company = CoopCompany::where('id', $id)->first();

        if (empty($company))
            return redirect()->route('admin.deleted_company', ['id' => $id]);

        $employees['osgbEmployees'] = UserToCompany::whereHas('user', function ($query) {
            $query->where('job_id',1)->where('job_id', 4);
        })->where('company_id', $id)->get();

        $mandatory_files = CompanyToFile::with('file', 'type')->where('company_id', $id)->get();

        return view(
            'admin.company.home.index',
            [
                'company' => $company,
                'employees' => $employees,
                'mandatory_files' => $mandatory_files,
            ],
        );
    }

    public function showInfo($id)
    {
        $company = CoopCompany::where('id', $id)->first();
        if (empty($company))
            return redirect()->route('admin.deleted_company', ['id' => $id]);

        $allEmployees = User::whereBetween('job_id', [1, 7])->getQuery();
        $accountants['front'] = FrontAccountant::where('company_id', $id)->first();
        $accountants['out'] = OutAccountant::where('company_id', $id)->first();

        $employees['osgbEmployees'] = UserToCompany::whereHas('user', function ($query) {
            $query->whereBetween('job_id', [1, 7]);
        })->where('company_id', $id)->get();

        return (view(
            'admin.company.informations.index',
            [
                'company' => $company,
                'employees' => $employees,
                'accountants' => $accountants,
                'allEmployees' => $allEmployees,
            ],
        ));
    }

    public function showEmployees($id, Request $request)
    {
        $company = CoopCompany::where('id', $id)->first();

        if (empty($company))
            return redirect()->route('admin.deleted_company', ['id' => $id]);

        $deletedEmployees = [];

        if ($request->ajax()) {
            $coopEmployees = CoopEmployee::where('company_id', $id)->get();
            return DataTables::of($coopEmployees)
                ->make(true);
        }


        return view(
            'admin.company.employees.index',
            [
                'company' => $company,
                'deletedEmployees' => $deletedEmployees,
            ],
        );
    }
    /*
    public function index($id, Request $request)
    {
        $company = CoopCompany::where('id', $id)->first();

        if (empty($company))
            return redirect()->route('admin.deleted_company', ['id' => $id]);

        $allEmployees = User::whereBetween('job_id', [1, 7])->getQuery();
        $deletedEmployees = [];
        $accountants['front'] = FrontAccountant::where('company_id', $id)->first();
        $accountants['out'] = OutAccountant::where('company_id', $id)->first();

        $employees['osgbEmployees'] = UserToCompany::whereHas('user', function ($query) {
            $query->whereBetween('job_id', [1, 7]);
        })->where('company_id', $id)->get();

        if ($request->ajax()) {
            $coopEmployees = CoopEmployee::where('company_id', $id)->get();
            return DataTables::of($coopEmployees)
                ->make(true);
        }

        $mandatory_files = CompanyToFile::with('file', 'type')->where('company_id', $id)->get();

        return (view(
            'admin.company.bilgiler.index',
            [
                'company' => $company,
                'employees' => $employees,
                'allEmployees' => $allEmployees,
                'deletedEmployees' => $deletedEmployees,
                'accountants' => $accountants,
                'mandatory_files' => $mandatory_files,
            ],
        ));
    }
    */
    public function deletedIndex($id, Request $request)
    {
        $company = CoopCompany::where('id', $id)->onlyTrashed()->first();
        if ($request->ajax()) {
            $coopEmployees = CoopEmployee::where('company_id', $id)->get();
            return DataTables::of($coopEmployees)
                ->make(true);
        }
        $mandatory_files = CompanyToFile::with('file', 'type')->where('company_id', $id)->get();
        $accountants['front'] = FrontAccountant::where('company_id', $id)->first();
        $accountants['out'] = OutAccountant::where('company_id', $id)->first();
                

        return (view(
            'admin.deleted_company.index',
            [
                'company' => $company,
                'osgbEmployees' => null,
                'accountants' => $accountants,
                'mandatory_files' => $mandatory_files
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
            return redirect()
                ->route('admin.company.informations.index', ['id' => $company->id])
                ->with('fail', 'Değişiklerinizi uygularken bir hatayla karşılaştık!');
        }
        return redirect()
            ->route('admin.company.informations.index', ['id' => $company->id])
            ->with('success', 'Yaptığınız değişiklikler başarıyla uygulanmıştır!');
    }

    public function delete(CoopCompany $company)
    {
        try {
            CoopCompany::where('id', $company->id)->delete();
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.company.informations.index', ['id' => $company->id])
                ->with('fail', 'Silme esnasında bir hatayla karşılaşıldı!');
        }
        return redirect()
            ->route('admin.companies.index')
            ->with('success', 'Şirket başarıyla silinmiştir. Silinen işletmelere ARŞİV bölümünden ulaşabilirsiniz!');
    }

    public function assignEmployee(CoopCompany $company, Request $request)
    {
        try {
            UserToCompany::create([
                'user_id' => $request->user,
                'company_id' => $company->id
            ]);
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.company.informations.osgb', ['id' => $company->id])
                ->with('fail', 'Bir hata ile karşılaşıldı!',);
        }
        return redirect()
            ->route('admin.company.informations.osgb', ['id' => $company->id])
            ->with('success', 'Seçtiğiniz çalışan şirketiniz ile eşleştirildi!');
    }

    public function addEmployee(CoopCompany $company, StoreCoopEmployeeRequest $request)
    {
        $request->validated();

        try {
            $formData = $request->except('_token');
            $formData['company_id'] = $company->id;
            CoopEmployee::create($formData);
        } catch (\Throwable $th) {
            return back()->with('fail', 'Bir hata ile karşılaşıldı!');
        }
        return back()->with('success', 'Yeni Çalışan Başarıyla Eklendi!');
    }

    public function deleteEmployee($company, $employee, Request $request)
    {
        try {
            CoopEmployee::where('id', $employee)->where('company_id', $company)->delete();
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.company.employees.deleted', ['id' => $company->id])
                ->with('fail', 'Bir hata ile karşılaşıldı!');
        }
        return redirect()
            ->route('admin.company.employees.deleted', ['id' => $company->id])
            ->with(
                'success',
                'Çalışan başarıyla silindi. Silinen çalışanlara ARŞİV bölümünden ulaşabilirsiniz',
            );
    }

    public function addAcc(CoopCompany $company, StoreAccountantRequest $request)
    {
        $request->validated();
        if ($request->front_acc_name === null && $request->out_acc_name === null) {
            return redirect()
                ->route('admin.company.informations.acc', ['id' => $company->id])
                ->with('fail', 'Eksik bilgi girdiniz!');
        }

        if ($request->front_acc_name !== null) {
            try {
                FrontAccountant::create([
                    'name' => $request->front_acc_name,
                    'company_id' => $company->id,
                    'email' => $request->front_acc_email,
                    'phone' => $request->front_acc_phone,
                ]);
            } catch (\Throwable $th) {
                throw $th;
                return redirect()
                    ->route('admin.company.informations.acc', ['id' => $company->id])
                    ->with('fail', 'Ön muhasebe eklenirken bir hata ile karşılaşıldı!');
            }
        }

        if ($request->out_acc_name !== null) {
            try {
                OutAccountant::create([
                    'name' => $request->out_acc_name,
                    'company_id' => $company->id,
                    'email' => $request->out_acc_email,
                    'phone' => $request->out_acc_phone,
                ]);
            } catch (\Throwable $th) {
                return redirect()
                    ->route('admin.company.informations.acc', ['id' => $company->id])
                    ->with('fail', 'Dış muhasebe eklenirken bir hata ile karşılaşıldı!');
            }
        }

        return redirect()
            ->route('admin.company.informations.acc', ['id' => $company->id])
            ->with('success', 'Muhasebeciler başarıyla eklendi!');
    }

    public function uploadAcc(CoopCompany $company, StoreAccountantRequest $request)
    {
        $request->validated();
        try {
            $out_acc = OutAccountant::where('company_id', $company->id)->first();
            $out_acc_demand = [
                'name' => $request->out_acc_name,
                'email' => $request->out_acc_email,
                'phone' => $request->out_acc_phone,
            ];
            if ($out_acc !== null) {
                $out_acc_change = array_diff_assoc($out_acc_demand, $out_acc->toArray());
                if ($out_acc_change !== null && $out_acc_demand['name'] !== null) {
                    $out_acc->update($out_acc_change);
                }
            }
            if ($out_acc === null && $out_acc_demand['name'] !== null) {
                $out_acc_demand['company_id'] = $company->id;
                OutAccountant::create($out_acc_demand);
            }
        } catch (\Throwable $th) {
            throw $th;
            return redirect()
                ->route('admin.company.informations.acc', ['id' => $company->id])
                ->with('fail', 'Bir Hata ile Karşılaşıldı!');
        }

        try {
            $front_acc = FrontAccountant::where('company_id', $company->id)->first();
            $front_acc_demand = [
                'name' => $request->front_acc_name,
                'email' => $request->front_acc_email,
                'phone' => $request->front_acc_phone,
            ];
            if ($front_acc !== null) {
                $front_acc_change = array_diff_assoc($front_acc_demand, $front_acc->toArray());
                if ($front_acc_change !== null && $front_acc_demand['name'] !== null) {
                    $front_acc->update($front_acc_change);
                }
            }
            if ($front_acc === null && $front_acc_demand['name'] !== null) {
                $front_acc_demand['company_id'] = $company->id;
                FrontAccountant::create($front_acc_demand);
            }
        } catch (\Throwable $th) {
            throw $th;
            return redirect()
                ->route('admin.company.informations.acc', ['id' => $company->id])
                ->with('fail', 'Bir Hata ile Karşılaşıldı!');
        }

        return redirect()
            ->route('admin.company.informations.acc', ['id' => $company->id])
            ->with('success', 'Değişiklikleriniz başarıyla uygulanmıştır!');
    }
}
