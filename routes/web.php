<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

//ruta principal
Route::get('/', [HomeController::class, 'index']);

//login y logout
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/logout', function () {
    return 'Logout usuario';
});

//categorias
Route::get('/category', function () {
    return view('category.index');
});
Route::get('/category/show/{id}', function ($id) {
    return view('category.show', ['id' => $id]);
});

Route::get('/category/create', function () {
    return view('category.create');
});

Route::get('/category/edit/{id}', function ($id) {
    return view('category.edit', ['id' => $id]);
});