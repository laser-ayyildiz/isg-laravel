<?php

namespace App\Http\Controllers\Admin;

use App\Models\CoopCompany;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class DeletedCompanyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CoopCompany::query()
                ->onlyTrashed();
            return DataTables::of($data)
                ->make(true);
        }

        return view(
            'admin.deleted_companies',
        );
    }

    public function delete($id)
    {
        try {
            $company = CoopCompany::withTrashed()->find($id);
            $company->forceDelete();
        } catch (\Throwable $th) {
            return redirect()->route('admin.deleted_companies')->with('fail', 'Bir Hatayla Karşılaşıldı!');
        }
        return redirect()->route('admin.deleted_companies')->with('success', 'İşletme Tamamen Kaldırıldı!');
    }

    public function update($id)
    {
        try {
            $company = CoopCompany::withTrashed()->find($id);
            $company->restore();
        } catch (\Throwable $th) {
            return redirect()->route('admin.deleted_companies')->with('fail', 'Bir Hatayla Karşılaşıldı!');
        }
        return redirect()->route('admin.deleted_companies')->with('success', 'İşletme Tekrar Aktifleştirildi!');
    }
}
