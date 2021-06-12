<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login',[App\Http\Controllers\UserController::class,'login']);
Route::post('/register',[App\Http\Controllers\UserController::class,'register']);
Route::post('/admin',[App\Http\Controllers\PermissionController::class,'permission']);
Route::post('/roles',[App\Http\Controllers\PermissionController::class,'rolePermission']);

Route::group([
    'middleware'=>'auth:api'], function() {

        Route::get('/',function() {
            return response()->json(["welcome"=> auth()->user()->name]);
        });
        Route::post('/logout',[App\Http\Controllers\UserController::class,'logout']);
        Route::post('/createUser',[App\Http\Controllers\UserController::class,'registration']);
        Route::post('/assign/{user_id}/{role}',[App\Http\Controllers\RoleController::class,'roleAssign']);
        Route::get('/show',[App\Http\Controllers\UserController::class,'showUser']);
        Route::get('blogs/index',[App\Http\Controllers\BlogController::class,'index']);
        Route::post('blogs/create',[App\Http\Controllers\BlogController::class,'create']);
        Route::put('blogs/update/{id}',[App\Http\Controllers\BlogController::class,'update']);
        Route::delete('blogs/destroy/{id}',[App\Http\Controllers\BlogController::class,'destroy']);
});