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
            ->get();
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
            try {
                $this->activateRequest($request);
            } catch (\Throwable $th) {
                return back()->with('fail', 'Bir hata ile karşılaşıldı');
            }
            return redirect()->route('admin.osgb_employees')->with('success', 'Kullanıcı tekrar aktif hale gelmiştir');
        }

        if ($request->has('deleteRequest')) {
            try {
                $this->deleteRequest($request);
            } catch (\Throwable $th) {
                return back()->with('fail', 'Bir hata ile karşılaşıldı');
            }
            return redirect()->route('admin.deleted_employees')->with('success', 'Kullanıcı tamamen silinmiştir!');
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
