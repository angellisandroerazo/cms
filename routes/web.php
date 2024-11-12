<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ErrorsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index']);

Route::get('/posts', [PostController::class,'index']);

Route::get('/post/{slug}', [PostController::class,'view']);

Route::get('/category/{category}', [CategoryController::class,'viewPosts']);

Route::get('/tag/{tag}', [TagController::class,'viewPosts']);

Route::get('/tag/{tag}', [TagController::class,'viewPosts']);

Route::post('/comment', [CommentController::class,'store'])->name('comment');

Route::post('/logout', [UserController::class,'logout'])->name('logout');

//Route::get('/data', [ErrorsController::class,'viewError'])->name('data');
