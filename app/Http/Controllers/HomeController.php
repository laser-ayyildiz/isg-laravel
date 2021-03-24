<?php

namespace App\Http\Controllers;

use App\Models\CoopCompanies;
use App\Models\CoopEmployees;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $comp_count = CoopCompanies::count();
        $emp_count = CoopEmployees::count();
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
