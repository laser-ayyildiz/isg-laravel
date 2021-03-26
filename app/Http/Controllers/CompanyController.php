<?php

namespace App\Http\Controllers;

use Illumi8nate\Http\Request;
use App\Models\CoopCompanies;
use Hashids\Hashids;

class CompanyController extends Controller
{
    public function index($id)
    {
        $a = new Hashids();
        $id = $a->decode($id, 15, 298, 177)[0];
        $company = CoopCompanies::where('id', $id)->first();

        return (view(
            'admin.company',
            ['company' => $company]
        ));
    }
}
