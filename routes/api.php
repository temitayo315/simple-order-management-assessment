<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user/store', [AuthenticationController::class, 'register']);
Route::post('login', [AuthenticationController::class, 'login']);
Route::get('product', [ProductController::class, 'index']);
Route::get('show/{product}', [ProductController::class, 'show']);

Route::middleware(['jwt.auth'])->group(function () {
    Route::controller(ProductController::class)->group(function () {        
        Route::post('store', 'store');
        Route::put('update/{product}', 'update');
        Route::delete('delete/{product}', 'destroy');
    });
});