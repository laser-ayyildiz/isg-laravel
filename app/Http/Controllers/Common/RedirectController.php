<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('Admin'))
            return redirect('/admin/home');

        if (Auth::user()->hasRole('User'))
            return redirect('/user/home');

        if (Auth::user()->hasRole('CompanyAdmin'))
            return redirect('/company-admin/home');
    }
}
