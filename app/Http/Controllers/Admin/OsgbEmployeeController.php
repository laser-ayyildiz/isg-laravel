<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\CreateOsgbEmployee;
use Illuminate\Support\Facades\Auth;

class OsgbEmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::query()
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
        $this->validate($request, [
            'job_id' => ['required','numeric',Rule::in([1,4,5,6,7])],
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string',
            'phone' => 'required|numeric|digits:11',
            'tc' => 'required|numeric|digits:11|unique:users,tc',
            'rec_date' => 'required|before_or_equal:' . date("Y-m-d H:i:s"),
        ],[],
        [
            'job_id' => 'Kullanıcı Türü',
            'email' => 'Email',
            'tc' => 'T.C. Kimlik No',
            'name' => 'Ad Soyad',
            'phone' => 'Telefon No',
            'rec_date' => 'İşe Giriş Tarihi'
        ]);
        
        $chars = "1234567890abcdefghijKLMNOPQRSTuvwxyzABCDEFGHIJklmnopqrstUVWXYZ0987654321+-/*-?=&%!";
        $password = '';
        for ($i = 0; $i < 16; $i++) {
            $password .= $chars[rand() % 72];
        }
        try {
            $user = User::create([
                'job_id' => $request->job_id,
                'recruitment_date' => $request->rec_date,
                'name' => $request->name,
                'email' => $request->email,
                'tc' => $request->tc,
                'phone' => $request->phone,
                'password' => Hash::make($password)
            ])->syncRoles('User');
        } catch (\Throwable $th) {
            return redirect()->back()->with('fail', 'Çalışan kayıt edilirken bir hata ile karşılaşıldı!');
        }

        try {
            $user->notify(new CreateOsgbEmployee($user, $password));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return redirect()->back()->with('fail', 'Mail gönderme işleminde bir sıkıntı yaşıyoruz. Lütfen daha sonra tekrar deneyiniz!');
        }
        return redirect()->back()->with('success', 'Çalışan oluşturuldu. Giriş bilgileri mail olarak gönderildi!');
    }

    public function handle(Request $request)
    {
        $id = $request->input('userId');
        if ($request->has('deleteRequest')) {
            try {
                $this->delete($request, $id);
            } catch (\Throwable $th) {
                return redirect()->back()->with('fail', 'İşleminiz gerçekleştrilirken bir hata ile karşılaşıldı!');
            }
            return redirect()->back()->with('success', 'Kullanıcı silinmiştir. Silinen çalışanları Arşiv bölümünde bulabilirsiniz!');
        }
        if ($request->has('changeRequest')) {
            try {
                $this->change($request, $id);
            } catch (\Throwable $th) {
                return redirect()->back()->with('fail', 'İşleminiz gerçekleştrilirken bir hata ile karşılaşıldı!');
            }
            return redirect()->back()->with('success', 'Değişiklikleriniz başarıyla uygulanmıştır!');
        }
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
}
