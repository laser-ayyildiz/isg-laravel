<?php

namespace App\Http\Controllers\Common;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index()
    {
        return view('common.profile');
    }

    public function updatePicture(Request $request)
    {
        try {
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                $image = Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/profile_pictures/' . $filename));
                $user = Auth::user();
                $user->profile_photo_path = $filename;
                $user->save();
            } else {
                return redirect()->route('profile.index')->with('statusFail', 'Hata');
            }
        } catch (Exception $e) {
            return redirect()->route('profile.index')->with('statusFail', 'Hata');
        }
        return redirect()->route('profile.index')->with('statusSuccess', 'Profil Resminiz başarıyla güncellenmiştir');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'newPasswordAgain' => 'required'
        ],[],
        [
            'oldPassword' => 'Mevcut Parola',
            'newPassword' => 'Yeni Parola',
            'newPasswordAgain' => 'Yeni Parola Tekrar',
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->oldPassword, $hashedPassword)) {
            if (!Hash::check($request->newPassword, $hashedPassword)) {
                if ($request->newPassword == $request->newPasswordAgain) {
                    $user = User::find(Auth::user()->id);
                    $user->password = Hash::make($request->newPassword);
                    try {
                        User::where('id', $user->id)->update(array('password' =>  $user->password));
                    } catch (\Throwable $th) {
                        dd($th);
                        return redirect()->route('profile.index')->with('statusFail', 'Bir hata ile karşılaşıldı!');
                    }
                    return redirect()->route('profile.index')->with('statusSuccess', 'Parolanız başarıyla güncellenmiştir');
                } else {
                    return redirect()->route('profile.index')->with('statusFail', 'Yeni parolalarınız birbiriyle eşleşmedi!');
                }
            } else {
                return redirect()->route('profile.index')->with('statusFail', 'Eski parolanız ile yeni parolanız aynı!');
            }
        } else {
            return redirect()->route('profile.index')->with('statusFail', 'Eski parolanızı hatalı girdiniz!');
        }
    }

    public function updateIdCard(Request $request)
    {
        if (Auth::user()->hasRole('CompanyAdmin')) {
            $this->validate($request, [
                'email' => 'required|email|unique:users,email,' . Auth::id(),
                'name' => 'required|string'
            ],[],
            [
                'email' => 'Email',
                'name' => 'Ad Soyad',
            ]);
        } else {
            $this->validate($request, [
                'email' => 'required|email|unique:users,email,' . Auth::id(),
                'name' => 'required|string',
                'phone' => 'required|numeric|digits:11',
                'tc' => 'required|numeric|digits:11|unique:users,tc,' . Auth::id(),
                'recruitment_date' => 'required|before_or_equal:' . date("Y-m-d H:i:s"),
            ],[],
            [
                'email' => 'Email',
                'tc' => 'T.C. Kimlik No',
                'name' => 'Ad Soyad',
                'phone' => 'Telefon No',
                'recruitment_date' => 'İşe Giriş Tarihi'
            ]);
        }
        try {
            User::where('id', Auth::user()->id)->update($request->except(['_token', 'bilgi_kaydet']));
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('profile.index')->with('statusFail', 'Hata');
        }
        return redirect()->route('profile.index')->with('statusSuccess', 'Profil bilgileriniz başarıyla güncellenmiştir');
    }
}
