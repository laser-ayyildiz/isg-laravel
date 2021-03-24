<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoopCompanies;

class ChangeValidateController extends Controller
{
    public function index()
    {
        $companies = CoopCompanies::where('change', 1)->paginate(15);
        return view(
            'admin.change_validate',
            [
                'companies' => $companies
            ]
        );
    }
}
