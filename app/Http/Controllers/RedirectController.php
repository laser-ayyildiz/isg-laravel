<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{

    public function index()
    {
        if (Auth::user()->hasRole('Admin'))
            return redirect('/admin/home');

        if (Auth::user()->hasRole('User'))
            return redirect('/user/home');
    }
}
