<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Models\User;
use App\Models\CoopCompany;
use App\Models\CoopEmployee;
use Illuminate\Http\Request;
use App\Models\CompanyToFile;
use App\Models\DeleteRequest;
use App\Models\OutAccountant;
use App\Models\UpdateRequest;
use App\Models\UserToCompany;
use App\Models\FrontAccountant;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAccountantRequest;
use App\Http\Requests\StoreCoopEmployeeRequest;

class CompanyController extends Controller
{
    public function index($id, Request $request)
    {
        $relation = UserToCompany::where('company_id', $id)->where('user_id', Auth::id())->count();
        if ($relation < 1)
            abort(403);

        $company = CoopCompany::where('id', $id)->first();

        $allEmployees = User::whereBetween('job_id', [1, 7])->getQuery();
        $deletedEmployees = [];
        $accountants['front'] = FrontAccountant::where('company_id', $id)->first();
        $accountants['out'] = OutAccountant::where('company_id', $id)->first();

        $employees['osgbEmployees'] = UserToCompany::whereHas('user', function ($query) {
            $query->whereBetween('job_id', [1, 7]);
        })->where('company_id', $id)->get();

        if ($request->ajax()) {
            $coopEmployees = CoopEmployee::where('company_id', $id)->get();
            return DataTables::of($coopEmployees)->make(true);
        }

        $mandatory_files = CompanyToFile::with('file', 'type')->where('company_id', $id)->get();

        return (view(
            'company-admin.company.index',
            [
                'company' => $company,
                'employees' => $employees,
                'allEmployees' => $allEmployees,
                'deletedEmployees' => $deletedEmployees,
                'accountants' => $accountants,
                'deleted' => false,
                'mandatory_files' => $mandatory_files,
            ],
        ));
    }

    public function addEmployee(CoopCompany $company, StoreCoopEmployeeRequest $request)
    {
        $request->validated();

        try {
            $formData = $request->except('_token');
            $formData['company_id'] = $company->id;
            CoopEmployee::create($formData);
        } catch (\Throwable $th) {
            return back()->with(
                [
                    'fail' => 'Bir hata ile karşılaşıldı!',
                    'tab' => 'isletme_calisanlar'
                ]
            );
        }
        return back()->with(
            [
                'success' => 'Yeni Çalışan Başarıyla Eklendi!',
                'tab' => 'isletme_calisanlar'
            ]
        );
    }
}
