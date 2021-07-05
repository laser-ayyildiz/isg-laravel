<?php

namespace App\Http\Controllers\User;

use App\Models\CoopCompany;
use Illuminate\Http\Request;
use App\Models\UserToCompany;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeletedCompanyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = UserToCompany::with('company')->where('user_id', Auth::id())->get();
            $deleted_ids = [];
            foreach ($data as $value) {
                if (!isset($value->company)) {
                    $deleted_ids[] = $value->company_id;
                }
            }
            $companies = CoopCompany::onlyTrashed()->whereIn('id', $deleted_ids)->get();
            return DataTables::of($companies)
                ->make(true);
        }
        return view(
            'user.deleted_companies'
        );
    }
}
