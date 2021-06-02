<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Models\User;
use App\Models\CoopCompany;
use Illuminate\Http\Request;
use App\Models\UserToCompany;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CoopCompanyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = UserToCompany::with('company')->where('user_id', Auth::id())->get();
            $data = $data->unique('company_id');
            $companies = [];
            foreach ($data as $value) {
                if (isset($value->company)) {
                    $companies[] = $value->company;
                }
            }
            return DataTables::of($companies)
                ->make(true);
        }
        return view('company-admin.companies');
    }
}
