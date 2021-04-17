<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/companies', [CoopCompanyController::class, 'index'])->name('companies.index');
Route::post('/companies', [CoopCompanyController::class, 'store'])->name('companies.store');

Route::get('/deleted_companies', [DeletedCompanyController::class, 'index'])->name('deleted_companies');

Route::get('/change_validate', [ChangeValidateController::class, 'index'])->name('change_validate');
Route::post('/change_validate', [ChangeValidateController::class, 'deleteRequest'])->name('validate.delete');

Route::get('/osgb_employees', [OsgbEmployeeController::class, 'index'])->name('osgb_employees');
Route::post('/osgb_employees', [OsgbEmployeeController::class, 'handle'])->name('osgb_employees.handle');

Route::get('/deleted_employees', [DeletedEmployeeController::class, 'index'])->name('deleted_employees');

Route::get('/authentication', [AuthenticateController::class, 'index'])->name('authentication');

Route::get('/company/{id}', [CompanyController::class, 'index'])->name('company');
Route::get('/company/deleted/{id}', [CompanyController::class, 'deletedIndex'])->name('deleted_company');
Route::post('/company', [CompanyController::class, 'handle'])->name('company.handle');



Route::get('/settings', function () {
    return view('admin/settings');
})->name('settings');
