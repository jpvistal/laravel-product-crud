<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CategoryApiController;

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

Route::get('/category', [CategoryApiController::class, 'index'])->name('category.index');

Route::get('/product', [ProductApiController::class, 'index'])->name('product.index');
Route::post('/product', [ProductApiController::class, 'store'])->name('product.store');
Route::get('/product/{id}', [ProductApiController::class, 'show'])->name('product.show');
Route::put('/product/{id}', [ProductApiController::class, 'update'])->name('product.update');
Route::delete('/product/{id}', [ProductApiController::class, 'destroy'])->name('product.destroy');


