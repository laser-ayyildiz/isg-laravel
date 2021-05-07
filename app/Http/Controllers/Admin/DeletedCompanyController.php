<?php

namespace App\Http\Controllers\Admin;

use App\Models\CoopCompany;
use App\Models\Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $company = CoopCompany::withTrashed()->find($id);
        
        try {
            $company->forceDelete();
        } catch (\Exception $error) {
            Exception::create([
                'user_id' => Auth::id(),
                'exception' => $error,
                'function_name' => 'DeleteCompanyController->delete'
            ]);
            return redirect()->route('admin.deleted_companies')->with('fail', 'Bir Hatayla Karşılaşıldı!');
        }
        return redirect()->route('admin.deleted_companies')->with('success', 'İşletme Tamamen Kaldırıldı!');
    }

    public function update($id)
    {
        $company = CoopCompany::withTrashed()->find($id);

        try {
            $company->restore();
        } catch (\Exception $error) {
            Exception::create([
                'user_id' => Auth::id(),
                'exception' => $error,
                'function_name' => 'DeleteCompanyController->update'
            ]);
            return redirect()->route('admin.deleted_companies')->with('fail', 'Bir Hatayla Karşılaşıldı!');
        }
        return redirect()->route('admin.deleted_companies')->with('success', 'İşletme Tekrar Aktifleştirildi!');

    }
}
