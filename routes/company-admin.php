<?php
namespace App\Http\Controllers\CompanyAdmin;

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/company-admin/home');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/companies', [CoopCompanyController::class, 'index'])->name('companies');

Route::get('/company/{id}', [CompanyController::class, 'index'])->name('company');

Route::prefix('employee')->group(function () {
    Route::get('/{employee}/company/{company}', [CoopEmployeeController::class, 'index'])->name('employee');
    Route::get('/deleted/{employee}', [CoopEmployeeController::class, 'deletedIndex'])->name('deleted-employee');    
});