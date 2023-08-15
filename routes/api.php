<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ProviderController;
use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\InvoiceDetailController;

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

Route::apiResource('categories', CategoryController::class);

Route::apiResource('products', ProductController::class);

Route::apiResource('departments', DepartmentController::class);

Route::apiResource('cities', CityController::class);

Route::apiResource('employees', EmployeeController::class);

Route::apiResource('clients', ClientController::class);

Route::apiResource('providers', ProviderController::class);

Route::apiResource('bills', BillController::class);

Route::apiResource('invoiceDetails', InvoiceDetailController::class);

