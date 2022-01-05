<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\UserController::class,'index'])->name('welcome');

Route::resource('users', UserController::class)->middleware('web');
Route::post('/login', [LoginController::class,'login'])->middleware('web')->name('login');
Route::get('/logout', [LoginController::class,'logout'])->middleware('web')->name('logout');
Route::post('/users/create/store', [UserController::class,'store'])->middleware('web')->name('usersStore');
Route::get('/chat',[ChatController::class,'show'])->name('chat');
Route::post('/message/save', [ChatController::class,'store'])->name('messageStore');
Route::get('/message/get', [ChatController::class, 'getMessages'])->name('getMessages');
Route::get('/message/first', [ChatController::class,'getFirst'])->name('messagesFirst');
Route::post('users/change', [ActivityController::class,"changeActivity"])->name('changeActivity');
Route::get('/user/active', [ActivityController::class,'getAllActiveUsers'])->name('allActive');

