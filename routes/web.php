<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectController;

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('index');
});

Route::get('/redirect', [RedirectController::class, 'index'])->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
