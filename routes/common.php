<?php

namespace App\Http\Controllers\Common;

use App\Models\File;
use App\Models\CompanyToFile;
use Illuminate\Support\Facades\DB;
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
    Route::post('/mandatory-files/{company}', [FileUploadController::class, 'mandatoryFiles'])->name('mandatory-file-upload');
});

Route::post('files/{folder}/{file_name}', function ($folder = null, $file_name = null) {
    $path = storage_path() . '/' . 'app' . '/public/uploads/' . $folder . '/' . $file_name;
    try {
        return Response::download($path);
    } catch (\Throwable $th) {
        throw $th;
        return redirect()->back()->with('fail', 'Bir hata ile karşılaşıldı!');
    }
})->name('download-file');

Route::post('delete-file/{type}/{file}', function ($type = null, $file = null) {

    try {
        File::where('id', $file)->delete();
        if ($type === 'CompanyToFile') {
            CompanyToFile::where('file_id', $file)->delete();
        }
    } catch (\Throwable $th) {
        DB::rollback();
        return redirect()->back()->with('fail', 'Bir hata ile karşılaşıldı!');
    }

    return redirect()->back()
        ->with(
            'success',
                "Dosya silindi. Silinen dosyalara tekrar ulaşabilmek için lütfen sistem yöneticiniz ile iletşime geçin."
                    . "<p><a href='mailto:destek@ozgurosgb.com.tr'>destek@ozgurosgb.com.tr</a></p>"
        );
})->name('delete-file');

Route::post('/upload-excel/{company}/employee-list', [UploadEmployeeTableController::class, 'store'])->name('store-excel');