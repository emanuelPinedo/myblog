<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;

//home
Route::get('/', [HomeController::class, 'getHome'])->name('home');
/*Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');*/

//protegido x login
Route::middleware('auth')->group(function () {

    //dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //categorias
    Route::get('/category', [CategoryController::class, 'getIndex'])->name('category.index');
    Route::get('/category/show/{id}', [CategoryController::class, 'getShow'])->name('category.show');
    Route::get('/category/create', [CategoryController::class, 'getCreate'])->name('category.create');
    Route::get('/category/edit/{id}', [CategoryController::class, 'getEdit'])->name('category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'postUpdate'])->name('category.update');
    Route::post('/category/store', [CategoryController::class, 'postStore'])->name('category.store');
    Route::delete('category/delete/{id}', [CategoryController::class, 'destroy']);

    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
});

require __DIR__.'/auth.php';