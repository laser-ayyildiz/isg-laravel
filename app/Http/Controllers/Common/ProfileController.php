<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index()
    {
        return view('common.profile');
    }

    public function handle(Request $request)
    {
        if ($request->has('update-password')) {
            $this->updatePassword($request);
            //return redirect()->route('admin.profile.index')->with('status', 'Silme talebiniz yöneticinize iletilmiştir!');
        }
        if ($request->has('update-picture')) {
            if ($this->updatePicture($request)) {
                return redirect()->route('profile.index')->with('status', 'Profil Resminiz başarıyla güncellenmiştir');
            } else {
                return redirect()->route('profile.index')->with('status', 'Hata');
            }
            //return redirect()->route('admin.profile.index')->with('status', 'Yaptığınız değişiklikler yöneticinize iletilmiştir. Lütfen onaylanana kadar bekleyiniz!');
        }
    }

    public function updatePicture(Request $request)
    {
        try {
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                dd($avatar);
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300, 300)->save(public_path('uploads/profile_pictures/' . $filename));
                $user = Auth::user();
                $user->profile_photo_path = $filename;
                $user->save();
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [

            'old-password' => 'required',
            'new-password' => 'required',
            'new-password-again' => 'required'
            ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->oldpassword, $hashedPassword)) {
            if (!Hash::check($request->newpassword, $hashedPassword)) {
                $users =admin::find(Auth::user()->id);
                $users->password = bcrypt($request->newpassword);
                admin::where('id', Auth::user()->id)->update(array( 'password' =>  $users->password));

                session()->flash('message', 'password updated successfully');
                return redirect()->back();
            } else {
                session()->flash('message', 'new password can not be the old password!');
                return redirect()->back();
            }
        } else {
            session()->flash('message', 'old password doesnt matched ');
            return redirect()->back();
        }
    }
}
