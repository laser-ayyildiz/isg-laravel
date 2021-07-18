<?php

namespace App\Http\Controllers\Common;

use App\Models\EmployeeGroup;
use Illuminate\Support\Facades\Route;

Route::get('/redirect', [RedirectController::class, 'index'])->name('redirect');

Route::get('/messages', [MessageController::class, 'index'])->name('messages');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

Route::prefix('/profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/updatePicture', [ProfileController::class, 'updatePicture'])->name('profile.updatePicture');
    Route::post('/updatePassword', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::post('/updateIdCard', [ProfileController::class, 'updateIdCard'])->name('profile.updateIdCard');
});

//////////////////////UPLOAD FILES/////////////////////////////////
Route::prefix('upload-file')->group(function () {
    Route::post('/{employee}', [FileUploadController::class, 'empFileUpload'])->name('employee-file-upload');
    Route::post('/mandatory-files/{company}', [FileUploadController::class, 'mandatoryFiles'])->name('mandatory-file-upload');
    Route::post('/batch-file/{company}', [FileUploadController::class, 'empBatchFileUpload'])->name('batch-file-upload');
    Route::post('monthly-files/{company}', [FileUploadController::class, 'monthlyFilesUpload'])->name('monthly-file-upload');
});
Route::post('/upload-excel/{company}/employee-list', [UploadEmployeeTableController::class, 'store'])->name('store-excel');

////////////////////////SHOW FILES////////////////////////////////
Route::post('files/{folder}/{file_name}', [ShowFilesController::class, 'download'])->name('download-file');
Route::get('files/{folder}/{file_name}', [ShowFilesController::class, 'show'])->name('show-file');

////////////////////////DELETE FILES////////////////////////////////
Route::post('delete-file/{type}/{file}', [DeleteFilesController::class, 'deleteFile'])->name('delete-file');
Route::post('delete-employee-file/{file}', [DeleteFilesController::class, 'deleteEmpFile'])->name('delete-employee-file');
Route::post('/delete/mandatory-files/{file}', [DeleteFilesController::class, 'deleteMandatoryFile'])->name('mandatory-file-delete');

////////////////////////EQUIPMENTS////////////////////////////////
Route::post('/add-equipment/{company}', [EquipmentController::class, 'add'])->name('add-equipment');
Route::post('/add-equipment-file', [EquipmentController::class, 'addFile'])->name('add-equipment-file');

Route::delete('/delete-equipment/{equipment}', [EquipmentController::class, 'delete'])->name('delete-equipment');
Route::delete('/delete-equipment-file/{file}', [EquipmentController::class, 'deleteFile'])->name('delete-equipment-file');

////////////////AJAX//////////////////////
Route::post('/get-all-companies', [AjaxPopulateController::class, 'getAllCompanies'])->name('getAllCompanies');
Route::post('/get-group-leaders', [AjaxPopulateController::class, 'getGroupLeaders'])->name('getGroupLeaders');
Route::post('/get-company-employees/{company}', [AjaxPopulateController::class, 'getCompanyEmployees'])->name('get-company-employees');
Route::post('/get-osgb-employees/{job_id}', [AjaxPopulateController::class, 'getOsgbEmployees'])->name('get-osgb-employees');

////////////////EMPLOYEE GROUP//////////////////////
Route::post('/company/{company}/add-employee-group', [EmployeeGroupController::class, 'add'])->name('add-employee-group');
Route::post('/company/{company}/add-assignment-file/{row_id}', [EmployeeGroupController::class, 'addFile'])->name('add-assignment-file');
Route::post('/company/{company}/delete-assignment-file/{row_id}', [EmployeeGroupController::class, 'deleteFile'])->name('delete-assignment-file');

