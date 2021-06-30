<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('product')->group(function () {
    Route::post('/', [ProductController::class, 'store'])->name('product.store');
    Route::put('/', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/{id}/history', [ProductController::class, 'history'])->name('product.history');
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'list'])->name('products.list');    
    Route::post('/', [ProductController::class, 'saveBatch'])->name('products.batch');    
});



