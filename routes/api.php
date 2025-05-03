<?php

use App\Http\Controllers\kontenController;
use App\Http\Controllers\AuthController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::get('/auth/profile', [AuthController::class, 'me']);
});




Route::get('/konten', [kontenController::class, 'index']);
Route::post('/konten', [kontenController::class, 'store']);
Route::get('/konten/{id}', [kontenController::class, 'show']);
Route::post('/konten/{id}', [kontenController::class, 'update']);
Route::delete('/konten/{id}', [kontenController::class, 'delete']);
