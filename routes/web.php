<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/posts', [PostController::class,'index']);

Route::get('/about', [HomeController::class,'about']);

Route::get('/contact', [HomeController::class,'contact']);

Route::get('/{slug}', [HomeController::class,'extraPage']);

Route::get('/post/{slug}', [PostController::class,'view']);

Route::get('/category/{category}', [CategoryController::class,'viewPosts']);

Route::get('/tag/{tag}', [TagController::class,'viewPosts']);

Route::post('/logout', [UserController::class,'logout'])->name('logout');

//Route::get('/data', [ErrorsController::class,'viewError'])->name('data');
