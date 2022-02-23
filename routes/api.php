<?php

use App\Http\Controllers\API\V1\BrandController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\AuthController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => '/v1'], function () {
    
    Route::post('user/login', [AuthController::class, 'login']);
    
    Route::group(['middleware' => 'auth:api'], function () {
        
        Route::get('user/logout', [AuthController::class, 'logout']);
        Route::post('user/forgot-password', [AuthController::class, 'forgot_password']);
        Route::post('user/reset-password-token', [AuthController::class, 'reset']);

        Route::get('user/show', [UserController::class, 'show']);
        Route::post('user/create', [UserController::class, 'store']);
        Route::put('user/edit', [UserController::class, 'update']);
        Route::delete('user/delete', [UserController::class, 'destroy']);

    // Route::apiResources('brand', BrandController::class);
    });
});
