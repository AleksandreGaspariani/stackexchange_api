<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users',[UserController::class,'index']);
Route::get('/users/{id}',[UserController::class,'show']);

Route::get('/questions',[QuestionController::class, 'index']);
Route::get('/questions/{id}',[QuestionController::class, 'show']);
