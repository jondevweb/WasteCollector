<?php

use Illuminate\Support\Facades\Route;
use App\Models\Administrateur;

Route::get('/', function () {
    return view('welcome');
});
 
Route::get('tasks', function () {
    return view('admin/tasks', ['tasks' => Administrateur::all()]);
});

Route::get('admin', function () {
    return view('admin/welcome_login_admin');
});
