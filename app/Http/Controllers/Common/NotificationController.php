<?php

namespace App\Http\Controllers\Common;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications->sortByDesc('created_at')->paginate(10);

        return view('common.notifications', ['notifications' => $notifications]);
    }

    public function read($id)
    {
        try {
            Auth::user()->notifications->where('id', $id)->markAsRead();
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }

    public function delete($id)
    {
        try {
            auth()->user()->notifications()->where('id', $id)->delete();
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }

    public function readAll()
    {
        try {
            Auth::user()->notifications->markAsRead();
        } catch (\Throwable $th) {
            return back()->with('fail', 'Bir hata ile karşılaşıldı!');
        }
        return back()->with('success', 'Tüm bildirimler okundu olarak işaretlendi!');
    }

    public function deleteAll()
    {
        try {
            DB::table('notifications')->where('notifiable_id', Auth::id())->delete();
        } catch (\Throwable $th) {
            throw $th;
            return back()->with('fail', 'Bir hata ile karşılaşıldı!');
        }
        return back()->with('success', 'Tüm bildirimler silindi!');
    }
}
