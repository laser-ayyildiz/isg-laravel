<?php

namespace App\Http\Controllers\Common;

use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('common.profile');
    }

    public function updatePicture(Request $request)
    {
        $request->validate(
            [
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [],
            [
                'avatar' => 'Profil Resmi'
            ]
        );
        DB::beginTransaction();
        try {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
        
            $image_resize = Image::make($avatar->getRealPath());              
            $image_resize->resize(240, 240);
            $image_resize->save(storage_path('app/public/uploads/profile-pictures/' . $filename));

            $user = Auth::user();
            $user->profile_photo_path = '/files/profile-pictures/' . $filename;
            $user->save();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
            return redirect()->route('profile.index')->with('statusFail', 'Hata');
        }
        DB::commit();
        return redirect()->route('profile.index')->with('statusSuccess', 'Profil Resminiz başarıyla güncellenmiştir');
    }

    public function updatePassword(Request $request)
    {
        $this->validate(
            $request,
            [
                'oldPassword' => 'required',
                'newPassword' => 'required',
                'newPasswordAgain' => 'required'
            ],
            [],
            [
                'oldPassword' => 'Mevcut Parola',
                'newPassword' => 'Yeni Parola',
                'newPasswordAgain' => 'Yeni Parola Tekrar',
            ]
        );

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->oldPassword, $hashedPassword)) {
            if (!Hash::check($request->newPassword, $hashedPassword)) {
                if ($request->newPassword == $request->newPasswordAgain) {
                    $user = User::find(Auth::user()->id);
                    $user->password = Hash::make($request->newPassword);
                    try {
                        User::where('id', $user->id)->update(array('password' =>  $user->password));
                    } catch (\Throwable $th) {
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
            $this->validate(
                $request,
                [
                    'email' => 'required|email|unique:users,email,' . Auth::id(),
                    'name' => 'required|string'
                ],
                [],
                [
                    'email' => 'Email',
                    'name' => 'Ad Soyad',
                ]
            );
        } else {
            $this->validate(
                $request,
                [
                    'email' => 'required|email|unique:users,email,' . Auth::id(),
                    'name' => 'required|string',
                    'phone' => 'required|numeric|digits:11',
                    'tc' => 'required|numeric|digits:11|unique:users,tc,' . Auth::id(),
                    'recruitment_date' => 'required|before_or_equal:' . date("Y-m-d H:i:s"),
                ],
                [],
                [
                    'email' => 'Email',
                    'tc' => 'T.C. Kimlik No',
                    'name' => 'Ad Soyad',
                    'phone' => 'Telefon No',
                    'recruitment_date' => 'İşe Giriş Tarihi'
                ]
            );
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
