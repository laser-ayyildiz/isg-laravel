<?php

namespace App\Http\Controllers\Common;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

Route::get('/redirect', [RedirectController::class, 'index']);

Route::get('/messages', [MessageController::class, 'index'])->name('messages');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

Route::prefix('/profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/updatePicture', [ProfileController::class, 'updatePicture'])->name('profile.updatePicture');
    Route::post('/updatePassword', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::post('/updateIdCard', [ProfileController::class, 'updateIdCard'])->name('profile.updateIdCard');
});

Route::prefix('upload-file')->group(function () {
    Route::post('/{employee}', [FileUploadController::class, 'empFileUpload'])->name('employee-file-upload');
});

Route::post('files/{folder}/{file_name}', function ($folder = null, $file_name = null) {
    $path = storage_path() . '/' . 'app' . '/public/uploads/' . $folder . '/' . $file_name;
    try {
        return Response::download($path);
    } catch (\Throwable $th) {
        return redirect()->back()->with('fail', 'Bir hata ile karşılaşıldı!');
    }
})->name('download-file');

Route::post('/upload-excel/{company}/employee-list', [UploadEmployeeTableController::class, 'store'])->name('store-excel');
