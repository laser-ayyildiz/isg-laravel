<?php

namespace App\Http\Controllers\User;

use App\Models\CoopEmployee;
use Illuminate\Http\Request;
use App\Models\UserToCompany;
use App\Models\EmployeeToFile;
use App\Http\Controllers\Controller;
use App\Models\CoopCompany;
use Illuminate\Support\Facades\Auth;

class CoopEmployeeController extends Controller
{
    public function index($employee, CoopCompany $company)
    {
        $user = UserToCompany::with(['company', 'user'])
            ->where('user_id', Auth::id())
            ->where('company_id', $company->id)
            ->first();

        if ($user === null)
            abort(403);

        $demand = CoopEmployee::with('company')->where('id', $employee)->first();

        if (empty($demand))
            return redirect()->route('user.deleted.coop_employee', ['employee' => $employee]);

        $files = EmployeeToFile::where('employee_id', $employee)->with('file')->paginate(10);

        return view(
            'user.coop_employees',
            [
                'employee' => $demand,
                'deleted' => false,
                'files' => $files,
                'tab' => 'genel_bilgiler'
            ]
        );
    }

    public function deletedIndex($employee, CoopCompany $company)
    {
        $user = UserToCompany::with(['company', 'user'])
            ->where('user_id', Auth::id())
            ->where('company_id', $company->id)
            ->first();

        if ($user === null)
            abort(403);

        $employee = CoopEmployee::with('company')->where('id', $employee)->onlyTrashed()->first();
        $files = EmployeeToFile::where('employee_id', $employee)->with('file')->get();

        return view(
            'user.coop_employees',
            [
                'employee' => $employee,
                'deleted' => true,
                'files' => $files,
            ]
        );
    }

    public function update(CoopEmployee $employee, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|unique:coop_employees,email,' . $employee->id,
            'tc' => 'required|unique:coop_employees,tc,' . $employee->id . '|digits:11',
            'recruitment_date' => 'required|before_or_equal:' . date("Y-m-d H:i:s"),
            'phone' => 'digits:11'
        ]);
        $demand = array_diff_assoc($request->except(['_token', 'compName']), $employee->toArray());
        if (empty($demand))
            return redirect()->back()->with('fail', 'Hiçbir değişiklik yapmadığınızı fark ettik. Lütfen tekrar deneyin!');

        try {
            CoopEmployee::where('id', $employee->id)->update($demand);
        } catch (\Throwable $th) {
            return redirect()->back()->with('fail', 'Bir Hata ile Karşılaşıldı!');
        }
        return redirect()->back()->with('success', 'Değişiklikler başarıyla uygulandı!');
    }

    public function delete(CoopEmployee $employee)
    {
        $company = $employee->company->id;
        try {
            CoopEmployee::where('id', $employee->id)->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('fail', 'Bir Hata ile Karşılaşıldı!');
        }
        return redirect()->route('admin.company', ['id' => $company])->with('success', 'Çalışan silindi!');
    }
}