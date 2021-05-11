<?php
namespace App\Http\Controllers\Common;

use Illuminate\Support\Facades\Route;

Route::get('/redirect', [RedirectController::class, 'index']);

Route::get('/messages', [MessageController::class, 'index'])->name('messages');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile/updatePicture', [ProfileController::class, 'updatePicture'])->name('profile.updatePicture');
Route::post('/profile/updatePassword', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
Route::post('/profile/updateIdCard', [ProfileController::class, 'updateIdCard'])->name('profile.updateIdCard');
