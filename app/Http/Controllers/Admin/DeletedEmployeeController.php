<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class DeletedEmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::onlyTrashed()
            ->where('job_id', '<=', 7)
            ->with('job')
            ->where('job_id', '!=', null);
            return DataTables::of($data)
                ->make(true);

            //dd($data);
        }
        return view(
            'admin.deleted_employees'
        );
    }
}
