<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;

class DeletedEmployeeController extends Controller
{
    public function index()
    {
        $deleted_users = User::withTrashed()->where('job_id', '<=', 7)->paginate(15);
        //dd($deleted_users);
        return view(
            'admin.deleted_users',
            [
                'deleted_users' => $deleted_users
            ]
        );
    }
}
