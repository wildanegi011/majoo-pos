<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProductController::class, 'listProduct']);

Route::get('/login', [AuthController::class, 'show'])->name('show.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::post('/upload', [ProductController::class, 'upload'])->name('product.upload');
        Route::get('/datatable', [ProductController::class, 'datatable'])->name('product.datatable');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
        Route::delete('/deleteMany', [ProductController::class, 'destroyMany'])->name('product.destroyMany');
    });
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryProductController::class, 'index'])->name('category.index');
        Route::get('/datatable', [CategoryProductController::class, 'datatable'])->name('category.datatable');
        Route::get('/create', [CategoryProductController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryProductController::class, 'store'])->name('category.store');
        Route::get('/edit/{id}', [CategoryProductController::class, 'edit'])->name('category.edit');
        Route::put('/update/{id}', [CategoryProductController::class, 'update'])->name('category.update');
        Route::delete('/delete/{id}', [CategoryProductController::class, 'destroy'])->name('category.destroy');
        Route::delete('/deleteMany', [CategoryProductController::class, 'destroyMany'])->name('category.destroyMany');
    });
});
