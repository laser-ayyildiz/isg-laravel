<?php

namespace App\Http\Controllers;

use App\Models\OsgbEmployees;
use Illuminate\Http\Request;

class OsgbEmployeeController extends Controller
{
    public function index()
    {
        $osgb_employees = OsgbEmployees::where('deleted', 0)->paginate(15);
        return view(
            'admin.osgb_employees',
            [
                'osgb_employees' => $osgb_employees
            ]
        );
    }
}
