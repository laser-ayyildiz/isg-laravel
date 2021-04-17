<?php
namespace App\Http\Controllers\Common;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Common\RedirectController;

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('index');
});


/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/redirect', [RedirectController::class, 'index']);
});


Route::get('/messages', [MessageController::class, 'index'])->name('messages');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'updatePicture'])->name('profile.update');
