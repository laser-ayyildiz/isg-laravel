<?php

namespace App\Http\Controllers\Admin;

use App\Models\CoopCompany;
use Illuminate\Http\Request;
use App\Models\DeletedCompany;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class DeletedCompanyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CoopCompany::select('*')
            ->whereNotNull('deleted_at')
            ->orderBy('deleted_at', 'desc');
            return DataTables::of($data)
                ->make(true);
        }
        return view(
            'admin.deleted_companies',
        );
    }
}
