<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoopEmployee;
use Illuminate\Http\Request;

class CoopEmployeeController extends Controller
{
    public function index()
    {
    }
    public function store(Request $request)
    {

        CoopEmployee::create([
            'type' => $request->type,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'employer' => $request->employer,
            'city' => $request->countrySelect,
            'town' => $request->citySelect,
            'contract_at' => $request->contract_at,
        ]);
        return redirect()->route('companies');
    }
}
