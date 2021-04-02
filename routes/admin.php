<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\DeletedCompany;

Route::get('', [HomeController::class, 'index'])->name('home');

Route::get('/companies', [CoopCompanyController::class, 'index'])->name('companies');
Route::post('/companies', [CoopCompanyController::class, 'store']);

Route::get('/deleted_companies', [DeletedCompanyController::class, 'index'])->name('deleted_companies');

Route::get('/change_validate', [ChangeValidateController::class, 'index'])->name('change_validate');
Route::post('/change_validate', [ChangeValidateController::class, 'deleteRequest'])->name('validate.delete');

Route::get('/osgb_employees', [OsgbEmployeeController::class, 'index'])->name('osgb_employees');

Route::get('/deleted_users', [DeletedUserController::class, 'index'])->name('deleted_users');

Route::get('/authentication', [AuthenticateController::class, 'index'])->name('authentication');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile', [ProfileController::class, 'updatePicture'])->name('profile');

Route::get('/company/{id}', [CompanyController::class, 'index'])->name('company');
Route::get('/company/deleted/{id}', [CompanyController::class, 'deletedIndex'])->name('deleted_company');
Route::post('/company', [CompanyController::class, 'handle'])->name('company.handle');


Route::get('/messages', [MessageController::class, 'index'])->name('messages');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

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
