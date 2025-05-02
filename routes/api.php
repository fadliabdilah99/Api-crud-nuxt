<?php

use App\Http\Controllers\kontenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/konten', [kontenController::class, 'index']);
Route::post('/konten', [kontenController::class, 'store']);
Route::get('/konten/{id}', [kontenController::class, 'show']);
Route::post('/konten/{id}', [kontenController::class, 'update']);
Route::delete('/konten/{id}', [kontenController::class, 'delete']);