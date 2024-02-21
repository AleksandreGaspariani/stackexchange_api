<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);

Route::group(['prefix'=>'ext','middleware'=>['auth:sanctum','log']],function(){

    Route::get('/users',[UserController::class,'index']);
    Route::get('/users/{id}',[UserController::class,'show']);

    Route::get('/questions',[QuestionController::class, 'index']);
    Route::get('/questions/{id}',[QuestionController::class, 'show']);

    Route::post('/logout',[AuthController::class, 'logout']);
});

Route::get('/test', function(){

});

