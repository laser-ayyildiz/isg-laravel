<?php

namespace App\Http\Controllers;

use App\Models\CoopCompany;
use App\Models\CoopEmployee;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $comp_count = CoopCompany::where('change', 0)->count();
        $emp_count = CoopEmployee::count();

        return view(
            'admin.home',
            [
                'comp_count' => $comp_count,
                'emp_count' => $emp_count
            ]
        );
        return view('admin.home');
    }
}
