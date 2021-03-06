<?php

namespace App\Http\Controllers\User;

use App\Models\CoopEmployee;
use Illuminate\Http\Request;
use App\Models\UserToCompany;
use App\Models\EmployeeToFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoopEmployeeRequest;
use Illuminate\Support\Facades\Auth;

class CoopEmployeeController extends Controller
{
    public function index($employee, $company)
    {
        $user = UserToCompany::with(['company', 'user'])
            ->where('user_id', Auth::id())
            ->where('company_id', $company)
            ->first();

        if (empty($user))
            abort(403);

        $demand = CoopEmployee::with('company')->where('id', $employee)->where('company_id', $company)->first();

        if (empty($demand))
            return redirect()->route('user.deleted.coop_employee', ['employee' => $employee, 'company' => $company]);

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

    public function deletedIndex($employee, $company)
    {
        $user = UserToCompany::with(['company', 'user'])
            ->where('user_id', Auth::id())
            ->where('company_id', $company)
            ->first();

        if ($user === null)
            abort(403);

        $employee = CoopEmployee::with('company')->where('id', $employee)->where('company_id', $company)->onlyTrashed()->first();

        if ($employee === null)
            abort(404);

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

    public function update(CoopEmployee $employee, StoreCoopEmployeeRequest $request)
    {
        $request->validated();
        $demand = array_diff_assoc($request->except(['_token', 'compName']), $employee->toArray());
        if (empty($demand))
            return redirect()->back()->with('fail', 'Hi??bir de??i??iklik yapmad??????n??z?? fark ettik. L??tfen tekrar deneyin!');

        try {
            CoopEmployee::where('id', $employee->id)->update($demand);
        } catch (\Throwable $th) {
            return redirect()->back()->with('fail', 'Bir Hata ile Kar????la????ld??!');
        }
        return redirect()->back()->with('success', 'De??i??iklikler ba??ar??yla uyguland??!');
    }

    public function delete(CoopEmployee $employee)
    {
        dd($employee);
        $company = $employee->company->id;
        try {
            CoopEmployee::where('id', $employee->id)->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('fail', 'Bir Hata ile Kar????la????ld??!');
        }
        return redirect()->route('user.company', ['id' => $company])->with('success', '??al????an silindi!');
    }

    public function restore($id)
    {
        try {
            CoopEmployee::withTrashed()->find($id)->restore();
        } catch (\Throwable $th) {
            return redirect()->back()->with('fail', 'Bir Hata ile Kar????la????ld??!');
        }
        return back()->with('success', '??al????an i??e geri al??nd??!');
    }
}
