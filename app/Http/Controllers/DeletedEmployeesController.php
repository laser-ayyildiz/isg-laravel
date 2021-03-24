<?php

namespace App\Http\Controllers;

use App\Models\OsgbEmployees;
use Illuminate\Http\Request;

class DeletedEmployeesController extends Controller
{
    public function index()
    {
        $deleted_employees = OsgbEmployees::where('deleted', 1)->paginate(15);
        return view(
            'admin.deleted_employees',
            [
                'deleted_employees' => $deleted_employees
            ]
        );
    }
}
