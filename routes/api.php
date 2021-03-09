<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\UserApiController;
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

Route::post('login', [ApiController::class,'login']);
Route::post('register',[UserApiController::class,'store']);

Route::get('blog','Api\ApiController@index');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('blog','Api\ApiController')->except(['index']);
    Route::apiResource('user','Api\UserApiController',[
        'except' => ['store']
    ]);
    Route::post('logout', [ApiController::class,'logout']);
});
