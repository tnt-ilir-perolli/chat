<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/users',[\App\Http\Controllers\UserController::class,'show']);
    Route::get('/user/{id}/messages', [\App\Http\Controllers\MessageController::class, 'show'])->name('user.show');
    Route::post('/sendMessage',[\App\Http\Controllers\MessageController::class, 'store']);
    Route::delete('/message/{id}',[\App\Http\Controllers\MessageController::class, 'destroy']);
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
