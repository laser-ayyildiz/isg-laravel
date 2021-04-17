<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class AuthenticateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*')
                ->with('job')
                ->where('job_id', '<=', 7)
                ->where('deleted_at', null);
            return DataTables::of($data)
                ->make(true);
        }
        return view(
            'admin.authentication'
        );
    }
}
