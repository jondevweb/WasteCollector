<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\ViewController;
use App\Http\Controllers\Api\TokenController;
use App\Models\Administrateur;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin',[ViewController::class, 'indexView']);
Route::post('/resetPassword', [PasswordResetController::class, 'resetPassword'])->name('resetPassword'); 
Route::post('/sanctum/token', [TokenController::class, 'createToken']);

Route::prefix('api')->middleware('auth:sanctum')->group(function () {
    Route::post('/login', [LoginController::class, 'login'])->name('login'); 
    Route::post('/logout' , [LoginController::class, 'logout'])->name('logout');
   
});

Route::prefix('/client')->group(function () {
    Route::get('/recup', function () {
        return view('client/reset_password_client');
    });
});

Route::get('tasks', function () {
    return view('admin/tasks', ['tasks' => Administrateur::all()]);
});