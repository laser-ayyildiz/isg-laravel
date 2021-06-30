<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class ShowFilesController extends Controller
{
    public function show($folder = null, $file_name = null)
    {
        $path = storage_path() . '/app/public/uploads/' . $folder . '/' . $file_name;
        return response()->file($path);
    }

    public function download($folder = null, $file_name = null)
    {
        $path = storage_path() . '/app/public/uploads/' . $folder . '/' . $file_name;
        try {
            return Response::download($path);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->with('fail', 'Bir hata ile karşılaşıldı!');
        }
    }
}
