<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SuppliersController;
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
    Route::post('/products/store', [ProductsController::class, 'store']);
    Route::get('/products/show', [ProductsController::class, 'show']);
    Route::put('/products/addQuantity', [ProductsController::class, 'addQuantity']);
    Route::put('/products/removeQuantity', [ProductsController::class, 'removeQuantity']);
    Route::post('/order/store', [OrdersController::class, 'store']);
    Route::put('/order/update', [OrdersController::class, 'updateStatus']);
    Route::get('/orders/show', [OrdersController::class, 'show']);
    Route::post('/supplier/store', [SuppliersController::class, 'store']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
