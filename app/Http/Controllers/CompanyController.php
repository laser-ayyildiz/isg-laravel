<?php

namespace App\Http\Controllers;

use App\Models\CoopCompanies;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index($id)
    {
        $company = CoopCompanies::where('id', $id)->first();

        return (view(
            'admin.company',
            ['company' => $company]
        ));
    }
}
