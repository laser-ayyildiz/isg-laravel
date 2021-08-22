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

    public function getCompanyEmployeesWithFiles(CoopCompany $company, $type)
    {
        if ($type == "deleted") {
            return CoopEmployee::where('company_id', $company->id)
                ->select('id', 'name', 'tc', 'phone', 'position', 'deleted_at')
                ->onlyTrashed()
                ->get();
        } else if ($type == "active") {
            return CoopEmployee::where('company_id', $company->id)
                ->select('id', 'name', 'tc', 'phone', 'recruitment_date', 'first_edu', 'second_edu', 'examination')
                ->get();
        } else if ($type == "missing-docs") {
            return CoopEmployee::where('company_id', $company->id)
                ->where(function ($query) {
                    $query->where('first_edu', 0)
                        ->orWhere('second_edu', 0)
                        ->orWhere('examination', 0);
                })
                ->select('id', 'name', 'tc', 'phone', 'recruitment_date', 'first_edu', 'second_edu', 'examination')
                ->get();
        } else {
            return null;
        }
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
