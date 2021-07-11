<?php

namespace App\Http\Controllers\Admin;

use App\Models\Exception;
use App\Models\User;
use App\Models\CoopCompany;
use Illuminate\Http\Request;
use App\Models\UserToCompany;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmployeeAuthenticateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::query()
                ->with('job')
                ->where('job_id', '<=', 7)
                ->where('deleted_at', null);
            return DataTables::of($data)
                ->make(true);
        }

        $companies = CoopCompany::orderBy('name')->get();

        return view(
            'admin.authentication',
            [
                'companies' => $companies
            ]
        );
    }

    public function employeeAuthenticate(User $user, Request $request)
    {
        $exist = UserToCompany::where('user_id', $user->id)->where('company_id', $request->company)->count();
        if ($exist >= 1) {
            return back()->with(
                [
                    'fail' => 'Çalışan zaten bu işletmeye atanmış!',
                    'tab' => 'osgb_calisanlar'
                ]
            );
        }
        try {
            UserToCompany::create([
                'user_id' => $user->id,
                'company_id' => $request->company
            ]);
            return redirect()->route('admin.authentication')->with('success', 'Yetkilendirme Başarıyla Gerçekleştrildi');
        } catch (\Throwable $th) {
            return redirect()->route('admin.authentication')->with('fail', 'Bir Hata ile Karşılaşıldı');
        }
    }
}
