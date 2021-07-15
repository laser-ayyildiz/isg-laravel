<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Equipment;
use App\Models\CoopCompany;
use App\Models\CoopEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $emp_count = CoopEmployee::count();
        $companies = CoopCompany::select('id', 'name', 'contract_at', 'type', 'danger_type')->orderBy('name')->get();
        $equipment_count = Equipment::count();

        $types = [];
        $month_counts = array_fill(0, 12, 0);
        $dangers['less'] = $companies->where('danger_type', 1)->count();
        $dangers['medium'] = $companies->where('danger_type', 2)->count();
        $dangers['very'] = $companies->where('danger_type', 3)->count();
        foreach ($companies as $company) {
            array_key_exists($company->type, $types) ? $types[$company->type] += 1 : $types[$company->type] = 1;
            $month = intval(Date('m', strtotime($company->contract_at)));
            $month_counts[$month - 1] += 1;
        }

        arsort($types);

        $types = array_slice($types, 0, 5);

        $labels = array_keys($types);

        $values = array_values($types);

        return view(
            'admin.home',
            [
                'companies' => $companies,
                'comp_count' => $companies->count(),
                'emp_count' => $emp_count,
                'month_counts' => $month_counts,
                'labels' => $labels,
                'values' => $values,
                'dangers' => $dangers,
                'equipment_count' => $equipment_count
            ]
        );
    }
}
