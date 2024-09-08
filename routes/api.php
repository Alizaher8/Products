<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontSectionController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//-------------------- Front Routes ------------------//
Route::get('/get-sections', [FrontSectionController::class, 'showSections']);
Route::get('/get-products', [FrontSectionController::class, 'showProducts']);
Route::get('/get-oneProduct', [FrontSectionController::class, 'showOneProduct']);
