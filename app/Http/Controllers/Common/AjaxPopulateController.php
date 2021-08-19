<?php

namespace App\Http\Controllers\Common;

use App\Models\User;
use App\Models\CoopCompany;
use App\Models\CoopEmployee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxPopulateController extends Controller
{
    public function __invoke()
    {
        if (Auth::user()->hasRole("CompanyAdmin"))
            abort(403);
    }

    public function getAllCompanies()
    {
        return json_encode(CoopCompany::select('id', 'name')->get());
    }

    public function getGroupLeaders()
    {
        return json_encode(CoopCompany::select('id', 'name')->where('group_status', 'leader')->get());
    }

    public function getCompanyEmployees(CoopCompany $company)
    {
        return json_encode(CoopEmployee::where('company_id', $company->id)->select('id', 'name')->get());
    }

    public function getOsgbEmployees($job_id)
    {
        return json_encode(User::where('job_id', $job_id)->select('id', 'name')->get());
    }

    public function getCompanyEmployeesWithFiles(CoopCompany $company)
    {
        return CoopEmployee:: where('company_id', $company->id)
            ->select('id', 'name', 'tc', 'phone', 'recruitment_date', 'first_edu', 'second_edu', 'examination')
            ->get();
    }

    public function getCompanyEmployeesOnlyTrashed(CoopCompany $company)
    {
        return json_encode(
            CoopEmployee::where('company_id', $company->id)
                ->select('id', 'name')
                ->onlyTrashed()
                ->get()
        );
    }
}
