<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CoopEmployee;
use App\Models\EmployeeToFile;
class CoopEmployeeController extends Controller
{
    public function index($employee)
    {
        $demand = CoopEmployee::with('company')->where('id', $employee)->first();

        if (empty($demand))
            return redirect()->route('admin.deleted.coop_employee', ['employee' => $employee]);

        $files = EmployeeToFile::where('employee_id', $employee)->with('file')->paginate(10);

        return view(
            'admin.coop_employees',
            [
                'employee' => $demand,
                'deleted' => false,
                'files' => $files,
            ]
        );
    }

    public function deletedIndex($employee)
    {
        $employee = CoopEmployee::with('company')->where('id', $employee)->onlyTrashed()->first();
        $files = EmployeeToFile::where('employee_id', $employee)->with('file')->get();

        return view(
            'admin.coop_employees',
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
