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
            ->whereNotNull('job_id')
            ->with('job');
            return DataTables::of($data)
                ->make(true);
        }
        return view(
            'admin.deleted_employees'
        );
    }

    public function handle(Request $request)
    {
        if ($request->has('activateRequest')) {
            $this->activateRequest($request);
            return redirect()->route('admin.osgb_employees')->with('status', 'Kullanıcı tekrar aktif hale gelmiştir');
        }

        if ($request->has('deleteRequest')) {
            $this->deleteRequest($request);
            return redirect()->route('admin.deleted_employees')->with('status', 'Kullanıcı tamamen silinmiştir!');
        }
    }

    public function deleteRequest(Request $request)
    {
        User::where('id', $request->userId)->forceDelete();
    }

    public function activateRequest(Request $request)
    {
        User::where('id', $request->userId)->restore();
    }
}
