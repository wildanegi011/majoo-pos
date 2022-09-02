<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryProductController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::get('/listProduct', [ProductController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/create', [ProductController::class, 'store']);
        Route::put('/update', [ProductController::class, 'update']);
        Route::delete('/destroy', [ProductController::class, 'destroy']);
        Route::delete('/destroyMany', [ProductController::class, 'destroyMany']);
    });

    Route::group(['prefix' => 'category_product'], function () {
        Route::get('/', [CategoryProductController::class, 'index']);
        Route::post('/create', [CategoryProductController::class, 'store']);
        Route::put('/update', [CategoryProductController::class, 'update']);
        Route::delete('/destroy', [CategoryProductController::class, 'destroy']);
        Route::delete('/destroyMany', [CategoryProductController::class, 'destroyMany']);
    });
});
