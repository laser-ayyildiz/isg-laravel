<?php

namespace App\Http\Controllers\User;

use App\Models\Equipment;
use App\Models\CoopCompany;
use App\Models\CoopEmployee;
use App\Models\UserToCompany;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $relatedComps = UserToCompany::where('user_id', '=', Auth::user()->id)->pluck('company_id')->unique();
        $emp_count = CoopEmployee::whereIn('company_id', $relatedComps)->count();
        $companies = CoopCompany::select('contract_at', 'type', 'danger_type')->whereIn('id', $relatedComps)->get();

        $equipment_count = Equipment::whereIn('company_id', $relatedComps)->count();
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
            'user.home',
            [
                'comp_count' => count($companies),
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
