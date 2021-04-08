<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\UserHasJob;

class OsgbEmployeeController extends Controller
{
    public function index()
    {
        $employees = [];
        $temps = UserHasJob::with(['job', 'user'])->get();

        foreach ($temps as $temp) {
            $employees[$temp->user->name] = $temp->job->name;
        }
        dump($employees);
        $employees = User::role('User')->paginate(15);
        //dd($employees);
        /*
        $employees = User::where('auth_type', 1)
            ->orWhere('auth_type', 2)
            ->orWhere('auth_type', 3)
            ->orWhere('auth_type', 4)
            ->paginate(15);
            */
        return view(
            'admin.osgb_employees',
            [
                'employees' => $employees
            ]
        );
    }
}
