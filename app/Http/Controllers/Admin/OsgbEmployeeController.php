<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class OsgbEmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*')->with('job')
                ->where('job_id', '!=', null);
            return DataTables::of($data)
                ->make(true);
        }
        return view(
            'admin.osgb_employees'
        );
    }

    public function create(Request $request)
    {
        $password = random_int(100000, 9999999);
        User::create([
            'job_id' => $request->job_id,
            'recruitment_date' => $request->recruitment_date,
            'name' => $request->name,
            'email' => $request->email,
            'tc' => $request->tc,
            'phone' => $request->phone,
            'password' => Hash::make($password)
        ])->syncRoles('User');

        try {
            Mail::send(
                [],
                [],
                function ($message) use ($request, $password) {
                    $message->from('firat@ozgurosgb.com.tr');
                    //$message->sender('john@johndoe.com', 'John Doe');
                    $message->to($request->email, $request->name);
                    //$message->replyTo('john@johndoe.com', 'John Doe');
                    $message->subject('Üye Kaydı');
                    $message->setBody('Özgür OSGB üyeliğiiniz yapılmıştır. <br> Şifreniz : ' . $password, 'text/html');
                    //$message->priority(3);
                    //$message->attach('pathToFile');
                }
            );
        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->with('status', $e);
        }

        return redirect()->route('admin.osgb_employees')->with('status', 'Çalışan eklenmiştir!');
    }

    public function delete()
    {
        dd("delete");
    }
}
