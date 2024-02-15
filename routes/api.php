<?php

use App\Http\Controllers\Api\Admin\DivisionController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Admin\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\BrandController;
use App\Http\Controllers\Api\Admin\CategoryController;

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

Route::prefix('v1')->group(function(){
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/brands', [BrandController::class, 'index']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/sliders', [SliderController::class, 'index']);
    Route::get('/divisions', [DivisionController::class, 'index']);
});
