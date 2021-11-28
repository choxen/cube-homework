<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/products/store', [ProductController::class, 'store']);
    Route::get('/products/show', [ProductController::class, 'show']);
    Route::put('/products/addQuantity', [ProductController::class, 'addQuantity']);
    Route::put('/products/removeQuantity', [ProductController::class, 'removeQuantity']);
    Route::post('/order/store', [OrderController::class, 'store']);
    Route::put('/order/update', [OrderController::class, 'updateStatus']);
    Route::get('/orders/show', [OrderController::class, 'show']);
    Route::post('/supplier/store', [SupplierController::class, 'store']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
