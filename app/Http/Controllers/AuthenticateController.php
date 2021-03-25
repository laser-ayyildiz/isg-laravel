<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OsgbEmployees;

class AuthenticateController extends Controller
{
    public function index()
    {
        $employees = OsgbEmployees::where('deleted', 0)->paginate(15);
        return view(
            'admin.authentication',
            [
                'employees' => $employees
            ]
        );
    }
}
