<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'index'])->name('user.home');
