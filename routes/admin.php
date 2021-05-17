<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'index'])->name('home');

////////////////////////////////////////////////////////////////////////

Route::prefix('companies')->group(function () {
    Route::get('/', [CoopCompanyController::class, 'index'])->name('companies.index');
    Route::post('/', [CoopCompanyController::class, 'store'])->name('companies.store');
});

Route::prefix('deleted_companies')->group(function () {
    Route::get('/', [DeletedCompanyController::class, 'index'])->name('deleted_companies');
    Route::post('/update/{company}', [DeletedCompanyController::class, 'update'])->name('deleted_companies.update');
    Route::post('/delete/{company}', [DeletedCompanyController::class, 'delete'])->name('deleted_companies.delete');
});

////////////////////////////////////////////////////////////////////////

Route::prefix('change_validate')->group(function () {
    Route::get('/', [ChangeValidateController::class, 'index'])->name('change_validate');
    Route::post('/delete/{demand}', [ChangeValidateController::class, 'delete'])->name('change_validate.delete');
    Route::post('/update/{demand}', [ChangeValidateController::class, 'update'])->name('change_validate.update');
});

Route::prefix('osgb_employees')->group(function () {
    Route::get('/', [OsgbEmployeeController::class, 'index'])->name('osgb_employees');
    Route::post('/create', [OsgbEmployeeController::class, 'create'])->name('osgb_employees.create');
    Route::post('/update', [OsgbEmployeeController::class, 'handle'])->name('osgb_employees.handle');
});

Route::prefix('deleted_employees')->group(function () {
    Route::get('/', [DeletedEmployeeController::class, 'index'])->name('deleted_employees');
    Route::post('/', [DeletedEmployeeController::class, 'handle'])->name('deleted_employees.handle');
});

////////////////////////////////////////////////////////////////////////

Route::prefix('authentication')->group(function () {
    Route::get('/', [EmployeeAuthenticateController::class, 'index'])->name('authentication');
    Route::post('/update/{user}', [EmployeeAuthenticateController::class, 'employeeAuthenticate'])->name('authentication.employeeAuthenticate');
});

////////////////////////////////////////////////////////////////////////

Route::prefix('company')->group(function () {
    Route::get('/{id}', [CompanyController::class, 'index'])->name('company');
    Route::get('/deleted/{id}', [CompanyController::class, 'deletedIndex'])->name('deleted_company');
    Route::post('/delete/{company}', [CompanyController::class, 'delete'])->name('company.delete');
    Route::post('/update/{company}', [CompanyController::class, 'update'])->name('company.update');
    Route::post('/{company}/assignEmployee', [CompanyController::class, 'assignEmployee'])->name('company.assignEmployee');
    Route::post('/{company}/addEmployee', [CompanyController::class, 'addEmployee'])->name('company.addEmployee');
    Route::post('/{company}/deleteEmployee/{employee}', [CompanyController::class, 'deleteEmployee'])->name('company.deleteEmployee');
});

Route::prefix('employee')->group(function () {
    Route::get('/{employee}', [CoopEmployeeController::class, 'index'])->name('coop_employee');
    Route::get('/deleted/{employee}', [CoopEmployeeController::class, 'deletedIndex'])->name('deleted.coop_employee');
    Route::post('/update/{employee}', [CoopEmployeeController::class, 'update'])->name('coop_employee.update');
    Route::post('/delete/{employee}', [CoopEmployeeController::class, 'delete'])->name('coop_employee.delete');
});

////////////////////////////////////////////////////////////////////////

Route::get('/settings', function () {
    return view('admin/settings');
})->name('settings');
