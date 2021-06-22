<?php

namespace App\Http\Controllers\Common;

use App\Models\File;
use App\Models\CompanyToFile;
use App\Models\EmployeeToFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

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

Route::prefix('upload-file')->group(function () {
    Route::post('/{employee}', [FileUploadController::class, 'empFileUpload'])->name('employee-file-upload');
    Route::post('/mandatory-files/{company}', [FileUploadController::class, 'mandatoryFiles'])->name('mandatory-file-upload');
    Route::post('/batch-file/{company}', [FileUploadController::class, 'empBatchFileUpload'])->name('batch-file-upload');
});

Route::post('files/{folder}/{file_name}', function ($folder = null, $file_name = null) {
    $path = storage_path() . '/app/public/uploads/' . $folder . '/' . $file_name;
    try {
        return Response::download($path);
    } catch (\Throwable $th) {
        throw $th;
        return redirect()->back()->with('fail', 'Bir hata ile karşılaşıldı!');
    }
})->name('download-file');

Route::get('files/{folder}/{file_name}', function ($folder = null, $file_name = null) {
    $path = storage_path() . '/app/public/uploads/' . $folder . '/' . $file_name;

    return response()->file($path);
})->name('show-file');


Route::post('delete-file/{type}/{file}', function ($type = null, $file = null) {
    try {
        File::where('id', $file)->delete();
        if ($type === 'CompanyToFile') {
            CompanyToFile::where('file_id', $file)->delete();
        }
    } catch (\Throwable $th) {
        DB::rollback();
        return redirect()->back()->with([
            'tab' => 'isletme_rapor',
            'fail' => 'Bir hata ile karşılaşıldı!'
        ]);
    }

    return redirect()->back()
        ->with(
            [
                'tab' => 'isletme_rapor',
                'success' =>
                "Dosya silindi. Silinen dosyalara tekrar ulaşabilmek için lütfen sistem yöneticiniz ile iletşime geçin."
                    . "<p><a href='mailto:destek@ozgurosgb.com.tr'>destek@ozgurosgb.com.tr</a></p>"
            ]

        );
})->name('delete-file');

Route::get('/files/company-employee-lists/employee-table.xlsx', function () {
    return Response::download(storage_path() . '/app/public/uploads/company-employee-lists/employee-table.xlsx');
});

Route::post('/upload-excel/{company}/employee-list', [UploadEmployeeTableController::class, 'store'])->name('store-excel');

Route::post('delete-employee-file/{file}', function (File $file) {
    DB::transaction(function () use($file) {
        try {
            $file->delete();
            EmployeeToFile::where('file_id', $file->id)->delete();
        } catch (\Throwable $th) {
            return back()->with([
                'tab' => 'files',
                'fail' => 'Bir hata ile karşılaşıldı!'
            ]);
        }
    });
    return back()->with([
        'tab' => 'files',
        'success' => 'Dosya Silindi!'
    ]);
})->name('delete-employee-file');
