<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->name('home');

//Listar todos los posts
Route::get('/posts', [PostController::class,'index']);

//Paginas informativas
Route::get('/about', [HomeController::class,'about']);

Route::get('/contact', [HomeController::class,'contact']);

//Paginas extras
Route::get('/{slug}', [HomeController::class,'extraPage']);

//Ver posts
Route::get('/post/{slug}', [PostController::class,'view']);

//Categorias
Route::get('/category/{category}', [CategoryController::class,'viewPosts']);

Route::get('/tag/{tag}', [TagController::class,'viewPosts']);

