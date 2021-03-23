<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CourierCompanyNameController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\VendorController;

use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PermissionController;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']); 

    Route::apiResource('role', RoleController::class);
    Route::apiResource('user', UserController::class);
    Route::get('user-reset/{id}', [UserController::class, 'reset'])->name('user-reset');
    Route::apiResource('permission', PermissionController::class);

});


Route::group([
    'middleware' => 'api',
    'prefix' => 'V1',
   // 'namespace' => 'Api\V1'

], function ($router) {
    Route::apiResource('category', CategoryController::class); 
    Route::post('update-category/{id}', [CategoryController::class,'update']);

    Route::apiResource('brand', BrandController::class); 
    Route::post('update-brand/{id}', [BrandController::class,'update']);


    Route::apiResource('courier-company-name', CourierCompanyNameController::class);
    Route::post('update-courier-company-name/{id}', [CourierCompanyNameController::class,'update']);


    Route::apiResource('vendor', VendorController::class);
    Route::post('update-vendor/{id}', [VendorController::class,'update']);
    
    Route::apiResource('product', ProductController::class);
    Route::post('update-product/{id}', [ProductController::class,'update']);

});