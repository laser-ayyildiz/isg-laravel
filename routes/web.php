<?php

use App\Http\Controllers\AuthenticateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OsgbEmployeeController;
use App\Http\Controllers\CoopCompaniesController;
use App\Http\Controllers\ChangeValidateController;
use App\Http\Controllers\DeletedCompaniesController;
use App\Http\Controllers\DeletedEmployeesController;
use App\Http\Controllers\ProfileController;

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('', [HomeController::class, 'index'])->name('home');

    Route::get('/companies', [CoopCompaniesController::class, 'index'])->name('companies');
    Route::post('/companies', [CoopCompaniesController::class, 'store']);

    Route::get('/deleted_companies', [DeletedCompaniesController::class, 'index'])->name('deleted_companies');

    Route::get('/change_validate', [ChangeValidateController::class, 'index'])->name('change_validate');

    Route::get('/osgb_employees', [OsgbEmployeeController::class, 'index'])->name('osgb_employees');

    Route::get('/deleted_employees', [DeletedEmployeesController::class, 'index'])->name('deleted_employees');

    Route::get('/authentication', [AuthenticateController::class, 'index'])->name('authentication');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'updatePicture'])->name('profile');

    Route::get('/messages', function () {
        return view('admin/messages');
    })->name('messages');

    Route::get('/notifications', function () {
        return view('admin/notifications');
    })->name('notifications');

    Route::get('/profile', function () {
        return view('admin/profile');
    })->name('profile');

    Route::get('/reports', function () {
        return view('admin/reports');
    })->name('reports');

    Route::get('/settings', function () {
        return view('admin/settings');
    })->name('settings');

    Route::get('/upload_employee', function () {
        return view('admin/upload_employee');
    })->name('upload_employee');
});
