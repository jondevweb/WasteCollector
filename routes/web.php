<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\ViewController;
use App\Http\Controllers\Api\TokenController;
use App\Http\Controllers\CollectePointController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\DechetController;
use App\Models\Administrateur;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [ViewController::class, 'indexView']);
Route::prefix('/client')->group(function () {
    Route::get('/', [ViewController::class, 'indexView'])->name("client");
    Route::get('/recup', [ViewController::class, 'indexView']);
});
Route::post('/resetPassword', [PasswordResetController::class, 'resetPassword'])->name('resetPassword'); 
Route::post('/sanctum/token', [TokenController::class, 'createToken']);

Route::prefix('api')->middleware('auth:sanctum')->group(function () {
    Route::post('/collectePoint/{id}', [CollectePointController::class, 'findCollectePointById']); 
    Route::post('/collectePointChoose/{id}', [CollectePointController::class, 'findCollectePointByUser']); 
    Route::post('/createCollecte', [CollectePointController::class, 'storeCollectePoint']); 
    Route::post('/dechet', [DechetController::class, 'indexDechet']); 
    Route::post('/entreprise/{id}', [EntrepriseController::class, 'findEntrepriseById']); 
    Route::post('/login', [LoginController::class, 'login'])->name('login'); 
    Route::post('/logout' , [LoginController::class, 'logout'])->name('logout');
});

Route::get('/tasks', function () {
    return view('admin/tasks', ['tasks' => Administrateur::all()]);
});