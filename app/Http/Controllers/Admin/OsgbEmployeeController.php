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
            $data = User::select('*')
                ->with('job')
                ->where('job_id', '<=', 7)
                ->where('deleted_at', null);
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
            'recruitment_date' => $request->rec_date,
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

    public function delete(Request $request, $id)
    {
        $user = User::where('id', $id);
        $user->update($request->except('_token', 'deleteRequest', 'userId', 'email'));
        $user->delete();
    }

    public function change(Request $request, $id)
    {
        User::where('id', $id)
            ->update(
                $request->except('_token', 'changeRequest', 'userId')
            );
    }

    public function handle(Request $request)
    {
        $id = $request->input('userId');
        if ($request->has('deleteRequest')) {
            $this->delete($request, $id);
            return redirect()->route('admin.osgb_employees')->with('status', 'Kullanıcı silinmiştir. Silinen çalışanları Arşiv bölümünde bulabilirsiniz!');
        }
        if ($request->has('changeRequest')) {
            $this->change($request, $id);
            return redirect()->route('admin.osgb_employees')->with('status', 'Değişiklikleriniz başarıyla uygulanmıştır!');
        }
        if ($request->has('saveRequest')) {
            $this->create($request);
            return redirect()->route('admin.osgb_employees')->with('status', 'Yeni kullanıcı başarıyla eklenmiştir!');
        }
    }
}
