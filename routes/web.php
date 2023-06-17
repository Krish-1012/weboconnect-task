<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::match(['get'],'/', [UserController::class, 'usersList']);

Route::match(['get','post'],'/registration', [UserController::class, 'index']);
Route::match(['get','post'],'/login', [UserController::class, 'login']);
Route::match(['get','post'],'/update-profile/{id}', [UserController::class, 'updateProifle']);
Route::match(['post'],'/handleRegistration', [UserController::class, 'handleRegistration']);
Route::match(['get'],'/users-list', [UserController::class, 'usersList']);

