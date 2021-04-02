<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeletedUser;

class DeletedUserController extends Controller
{
    public function index()
    {
        $deleted_users = DeletedUser::paginate(15);
        return view(
            'admin.deleted_users',
            [
                'deleted_users' => $deleted_users
            ]
        );
    }
}
