<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/companies', [CoopCompanyController::class, 'index'])->name('companies.index');
Route::post('/companies', [CoopCompanyController::class, 'store'])->name('companies.store');

Route::get('/deleted_companies', [DeletedCompanyController::class, 'index'])->name('deleted_companies');
Route::post('/deleted_companies/update/{company}', [DeletedCompanyController::class, 'update'])->name('deleted_companies.update');
Route::post('/deleted_companies/delete/{company}', [DeletedCompanyController::class, 'delete'])->name('deleted_companies.delete');

Route::get('/change_validate', [ChangeValidateController::class, 'index'])->name('change_validate');
Route::post('/change_validate/delete/{demand}', [ChangeValidateController::class, 'delete'])->name('change_validate.delete');
Route::post('/change_validate/update/{demand}', [ChangeValidateController::class, 'update'])->name('change_validate.update');

Route::get('/osgb_employees', [OsgbEmployeeController::class, 'index'])->name('osgb_employees');
Route::post('/osgb_employees', [OsgbEmployeeController::class, 'handle'])->name('osgb_employees.handle');

Route::get('/deleted_employees', [DeletedEmployeeController::class, 'index'])->name('deleted_employees');
Route::post('/deleted_employees', [DeletedEmployeeController::class, 'handle'])->name('deleted_employees.handle');

Route::get('/authentication', [EmployeeAuthenticateController::class, 'index'])->name('authentication');
Route::post('/authentication/update/{user}', [EmployeeAuthenticateController::class, 'employeeAuthenticate'])->name('authentication.employeeAuthenticate');

Route::get('/company/{id}', [CompanyController::class, 'index'])->name('company');
Route::get('/company/deleted/{id}', [CompanyController::class, 'deletedIndex'])->name('deleted_company');
Route::post('/company/delete/{company}', [CompanyController::class, 'delete'])->name('company.delete');
Route::post('/company/update/{company}', [CompanyController::class, 'update'])->name('company.update');
Route::post('/company/{company}/assignEmployee', [CompanyController::class, 'assignEmployee'])->name('company.assignEmployee');


Route::get('/settings', function () {
    return view('admin/settings');
})->name('settings');
