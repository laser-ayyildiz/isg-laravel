<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoopCompany;
use App\Models\DeletedCompany;

class DeletedCompanyController extends Controller
{
    public function index()
    {
        $companies = DeletedCompany::orderBy('created_at', 'desc')->paginate(15);
        return view(
            'admin.deleted_companies',
            [
                'companies' => $companies
            ]
        );
    }
}
