<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Models\CoopEmployee;
use App\Models\UserToCompany;
use App\Models\EmployeeToFile;
use App\Http\Controllers\Controller;
use App\Models\CoopCompany;
use Illuminate\Support\Facades\Auth;

class CoopEmployeeController extends Controller
{
    public function index($employee, CoopCompany $company)
    {
        $user = UserToCompany::with(['company', 'user'])
            ->where('user_id', Auth::id())
            ->where('company_id', $company->id)
            ->first();

        if (empty($user))
            abort(403);

        $demand = CoopEmployee::with('company')->where('id', $employee)->where('company_id', $company->id)->first();

        if (empty($demand))
            return redirect()->route('company-admin.deleted-employee', ['employee' => $employee, 'company' => $company]);

        $files = EmployeeToFile::where('employee_id', $employee)->with('file')->paginate(10);

        return view(
            'company-admin.employees',
            [
                'employee' => $demand,
                'deleted' => false,
                'files' => $files,
            ]
        );
    }

    public function deletedIndex($employee, CoopCompany $company)
    {
        $user = UserToCompany::with(['company', 'user'])
            ->where('user_id', Auth::id())
            ->where('company_id', $company->id)
            ->first();

        if ($user === null)
            abort(403);

        $employee = CoopEmployee::with('company')->where('id', $employee)->where('company_id', $company->id)->onlyTrashed()->first();

        if ($employee === null)
            abort(404);

        $files = EmployeeToFile::where('employee_id', $employee)->with('file')->get();

        return view(
            'company-admin.employees',
            [
                'employee' => $employee,
                'deleted' => true,
                'files' => $files,
            ]
        );
    }
}
