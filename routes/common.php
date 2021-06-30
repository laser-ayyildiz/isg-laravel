<?php

namespace App\Http\Controllers\Common;

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

Route::post('assign-company-admin/{company}', [AssignCompanyAdminController::class, 'assign'])->name('assign-company-admin');

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

////////////////DELETE FILES//////////////////////////////////////////////////////////////////
Route::post('delete-file/{type}/{file}', [DeleteFilesController::class, 'deleteFile'])->name('delete-file');
Route::post('delete-employee-file/{file}', [DeleteFilesController::class, 'deleteEmpFile'])->name('delete-employee-file');
Route::post('/delete/mandatory-files/{file}', [DeleteFilesController::class, 'deleteMandatoryFile'])->name('mandatory-file-delete');
