<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthenticateController extends Controller
{
    public function index()
    {
        $employees = User::where('auth_type', 1)
            ->orWhere('auth_type', 2)
            ->orWhere('auth_type', 3)
            ->orWhere('auth_type', 4)
            ->paginate(15);
        return view(
            'admin.authentication',
            [
                'employees' => $employees
            ]
        );
    }
}
