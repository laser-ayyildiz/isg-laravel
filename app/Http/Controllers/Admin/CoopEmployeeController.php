<?php

namespace App\Http\Controllers\Admin;

use App\Models\CoopEmployee;
use Illuminate\Http\Request;
use App\Models\EmployeeToFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoopEmployeeRequest;

class CoopEmployeeController extends Controller
{
    public function index($employee)
    {
        $demand = CoopEmployee::with('company')->where('id', $employee)->first();

        if (empty($demand))
            return redirect()->route('admin.deleted.coop_employee', ['employeeId' => $employee]);

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

    public function deletedIndex($employeeId)
    {
        $employee = CoopEmployee::with('company')->withTrashed()->where('id', $employeeId)->first();
        if (empty($employee))
            abort(404);
        $files = EmployeeToFile::where('employee_id', $employeeId)->with('file')->orderByDesc('assigned_at')->get();

        return view(
            'admin.coop_employees',
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

    public function restore($id)
    {
        try {
            CoopEmployee::withTrashed()->find($id)->restore();
        } catch (\Throwable $th) {
            return redirect()->back()->with('fail', 'Bir Hata ile Karşılaşıldı!');
        }
        return back()->with('success', 'Çalışan işe geri alındı!');
    }
}
