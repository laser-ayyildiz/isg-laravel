<?php

namespace App\Http\Controllers\Common;

use App\Exports\CoopEmployeesExport;
use App\Http\Controllers\Controller;
use App\Models\CoopCompany;
use App\Models\UserToCompany;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class DownloadEmployeeTableController extends Controller
{
    public function export(CoopCompany $company)
    {
        if (!Auth::user()->hasRole('Admin'))
            if (UserToCompany::where(['user_id' => Auth::id(), 'company_id' => $company->id])->count() < 1)
                abort(403);

        return Excel::download(new CoopEmployeesExport($company->id), $company->name . '_calisanlar_' . date('Y-m-d_H-i-s') . '.xlsx');
    }
}
