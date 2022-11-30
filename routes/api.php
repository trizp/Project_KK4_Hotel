<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//public route
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/kamars', [KamarController::class, 'index']);
Route::get('/kamars/{id}', [KamarController::class, 'show']);
Route::get('/reservasis', [ReservasiController::class, 'index']);
Route::get('/reservasis/{id}', [ReservasiController::class, 'show']);
Route::get('/payments', [PaymentController::class, 'index']);
Route::get('/payments/{id}', [PaymentController::class, 'show']);
Route::get('/user', [AuthController::class, 'alluser']);
Route::get('/user/{id}', [AuthController::class, 'showuser']);

//protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('kamars', KamarController::class)->except(['create', 'edit', 'show', 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('reservasis', ReservasiController::class)->except(['create', 'edit', 'show', 'index']);
    Route::resource('payments', PaymentController::class)->except(['create', 'edit', 'show', 'index']);
});