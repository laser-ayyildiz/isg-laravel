<?php

use App\Models\CoopCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('companies', function () {
    return CoopCompany::all();
});
