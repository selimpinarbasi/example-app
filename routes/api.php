<?php

use App\Http\Controllers\ApiControllers\CategoryApiController;
use App\Http\Controllers\ApiControllers\NewsApiController;
use App\Http\Controllers\ApiControllers\UserApiController;
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

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's

    Route::post('addNews',[NewsApiController::class,'addNews']);
    Route::get('news/{id?}',[NewsApiController::class,'news']);
    Route::put('updateNews/{id}',[NewsApiController::class,'updateNews']);
    Route::delete('deleteNews/{id}',[NewsApiController::class,'deleteNews']);

    Route::post('login ',[UserApiController::class,'sendToken']);

    Route::get('user',[UserApiController::class,'user']);
    Route::get('user/{id?}',[UserApiController::class,'user']);
    Route::post('addUser',[UserApiController::class,'addUser']);
    Route::put('updateUser',[UserApiController::class,'updateUser']);
    Route::delete('deleteUser/{id}',[UserApiController::class,'deleteUser']);

    Route::get('category/{id?}',[CategoryApiController::class,'category']);
    Route::post('addCategory',[CategoryApiController::class,'addCategory']);
    Route::put('updateCategory',[CategoryApiController::class,'updateCategory']);
    Route::delete('deleteCategory/{id}',[CategoryApiController::class,'deleteCategory']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




