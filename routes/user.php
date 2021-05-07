<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/companies',[CoopCompanyController::class, 'index'])->name('companies.index');
Route::post('/companies', [CoopCompanyController::class, 'store'])->name('companies.store');

Route::get('/deleted_companies', [DeletedCompanyController::class, 'index'])->name('deleted_companies');
Route::post('/deleted_companies/update/{company}', [DeletedCompanyController::class, 'update'])->name('deleted_companies.update');
Route::post('/deleted_companies/delete/{company}', [DeletedCompanyController::class, 'delete'])->name('deleted_companies.delete');

Route::get('/company/{id}', [CompanyController::class, 'index'])->name('company');
Route::get('/company/deleted/{id}', [CompanyController::class, 'deletedIndex'])->name('deleted_company');
Route::post('/company/deleteRequest/{company}/{user}', [CompanyController::class, 'deleteRequest'])->name('company.deleteRequest');
Route::post('/company/updateRequest/{company}/{user}', [CompanyController::class, 'updateRequest'])->name('company.updateRequest');