<?php

namespace App\Http\Controllers\User;

use App\Models\Exception;
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

    public function delete($id)
    {
        $company = CoopCompany::withTrashed()->find($id);

        try {
            $company->forceDelete();
            return redirect()->route('user.deleted_companies')->with('success', 'İşletme Tamamen Kaldırıldı!');
        } catch (\Exception $error) {
            Exception::create([
                'user_id' => Auth::id(),
                'exception' => $error,
                'function_name' => 'DeleteCompanyController->delete'
            ]);
            return redirect()->route('user.deleted_companies')->with('fail', 'Bir Hatayla Karşılaşıldı!');
        }
    }

    public function update($id)
    {
        $company = CoopCompany::withTrashed()->find($id);

        try {
            $company->restore();
            return redirect()->route('user.deleted_companies')->with('success', 'İşletme Tekrar Aktifleştirildi!');
        } catch (\Exception $error) {
            Exception::create([
                'user_id' => Auth::id(),
                'exception' => $error,
                'function_name' => 'DeleteCompanyController->update'
            ]);
            return redirect()->route('user.deleted_companies')->with('fail', 'Bir Hatayla Karşılaşıldı!');
        }
    }
}
