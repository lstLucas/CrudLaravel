<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\AuthManager;

Route::resource('/users', UserController::class);

Route::get('/', [UserController::class,'index'])->middleware('auth');

Route::prefix('login')->name('login')->group(function(){ 
    Route::get('', [AuthManager::class,'login']);
    Route::post('', [AuthManager::class,'auth'])->name('.auth');
})->middleware('guest');

Route::prefix('register')->name('register.')->group(function(){ 
    Route::get('', [AuthManager::class,'register'])->name('form');
    Route::post('', [AuthManager::class,'create'])->name('create');
})->middleware('guest');

Route::prefix('admin')->namespace('Admin')->group(function(){
    Route::prefix('posts')->name('posts.')->group(function(){
        Route::get('/create', [PostController::class, 'create'])->name('create');

        Route::post('/store', [PostController::class, 'store'])->name('store');

    });
});

Route::prefix('user')->name('user.')->group(function(){
    Route::get('/list', [UserController::class,'index'])->name('index');
    Route::get('/{user}/edit', [UserController::class,'edit'])->name('edit');
    Route::put('/{user}/update', [UserController::class,'update'])->name('update');
    Route::patch('/{user}/status', [UserController::class,'status'])->name('status');
    Route::post('/store', [UserController::class, 'store'])->name('store');

});

Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');