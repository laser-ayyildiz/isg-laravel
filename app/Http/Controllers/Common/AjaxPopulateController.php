<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\CoopCompany;
use Illuminate\Http\Request;

class AjaxPopulateController extends Controller
{
    public function getAllCompanies()
    {
        return json_encode(CoopCompany::select('id','name')->get());
    }

    public function getGroupLeaders()
    {
        return json_encode(CoopCompany::select('id', 'name')->where('group_status', 'leader')->get());
    }
}
