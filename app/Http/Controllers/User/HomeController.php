<?php

namespace App\Http\Controllers\User;

use App\Models\CoopCompany;
use App\Models\CoopEmployee;
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
        $companies = CoopCompany::select('contract_at','type','danger_type')->get();
        $types = [];
        $month_counts = array_fill(0, 12, 0);
        $dangers = ['less' => 0, 'medium' => 0, 'very' => 0];
        foreach ($companies as $company) {
            if($company->danger_type == 1){
                $dangers['less'] += 1;
            }
            if($company->danger_type == 2){
                $dangers['medium'] += 1;
            }
            if($company->danger_type == 3){
                $dangers['very'] += 1;
            }
            array_key_exists($company->type,$types) ? $types[$company->type] += 1 : $types[$company->type] = 1;
            $month = intval(Date('m',strtotime($company->contract_at)));
            $month_counts[$month-1] += 1;
        }
    
        arsort($types);
        
        $types = array_slice($types,0,5);

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
            ]
        );
    }
}
