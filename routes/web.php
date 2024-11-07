<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostsController::class,'index']);

Route::get('/{slug}', [PostsController::class,'view']);

Route::get('/category/{category}', [CategoryController::class,'index']);
