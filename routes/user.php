<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/user/home');

Route::get('/home', [HomeController::class, 'index'])->name('home');

////////////////////////////////////////////////////////////////////////

Route::prefix('/companies')->group(function () {
    Route::get('/', [CoopCompanyController::class, 'index'])->name('companies.index');
    Route::post('/', [CoopCompanyController::class, 'store'])->name('companies.store');
});

Route::prefix('/deleted_companies')->group(function () {
    Route::get('/', [DeletedCompanyController::class, 'index'])->name('deleted_companies');
    Route::post('/update/{company}', [DeletedCompanyController::class, 'update'])->name('deleted_companies.update');
    Route::post('/delete/{company}', [DeletedCompanyController::class, 'delete'])->name('deleted_companies.delete');
});

////////////////////////////////////////////////////////////////////////

Route::prefix('/company')->group(function () {
    Route::get('/{id}', [CompanyController::class, 'index'])->name('company');
    Route::get('/deleted/{id}', [CompanyController::class, 'deletedIndex'])->name('deleted_company');
    Route::post('/deleteRequest/{company}/{user}', [CompanyController::class, 'deleteRequest'])->name('company.deleteRequest');
    Route::post('/updateRequest/{company}/{user}', [CompanyController::class, 'updateRequest'])->name('company.updateRequest');
    Route::post('/{company}/assignEmployee', [CompanyController::class, 'assignEmployee'])->name('company.assignEmployee');
    Route::post('/{company}/addEmployee', [CompanyController::class, 'addEmployee'])->name('company.addEmployee');
    Route::post('/{company}/deleteEmployee/{employee}', [CompanyController::class, 'deleteEmployee'])->name('company.deleteEmployee');
    Route::post('/{company}/add-accountant', [CompanyController::class, 'addAcc'])->name('company.add-accountant');
    Route::post('/{company}/upload-accountant', [CompanyController::class, 'uploadAcc'])->name('company.upload-accountant');
});

Route::prefix('employee')->group(function () {
    Route::get('/{employee}/company/{company}', [CoopEmployeeController::class, 'index'])->name('coop_employee');
    Route::get('/deleted/{employee}', [CoopEmployeeController::class, 'deletedIndex'])->name('deleted.coop_employee');
    Route::post('/update/{employee}', [CoopEmployeeController::class, 'update'])->name('coop_employee.update');
    Route::post('/delete/{employee}', [CoopEmployeeController::class, 'delete'])->name('coop_employee.delete');
    
});