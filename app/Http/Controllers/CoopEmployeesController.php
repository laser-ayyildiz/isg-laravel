<?php

namespace App\Http\Controllers;

use App\Models\CoopEmployees;
use Illuminate\Http\Request;

class CoopEmployeesController extends Controller
{
    public function index()
    {
    }
    public function store(Request $request)
    {

        CoopEmployees::create([
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
