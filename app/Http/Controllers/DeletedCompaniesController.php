<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoopCompanies;

class DeletedCompaniesController extends Controller
{
    public function index()
    {
        $companies = CoopCompanies::where('deleted', 1)->where('change', 0)->orderBy('updated_at')->paginate(15);
        return view(
            'admin.deleted_companies',
            [
                'companies' => $companies
            ]
        );
    }
}
