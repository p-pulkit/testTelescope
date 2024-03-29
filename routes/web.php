<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', App\Http\Controllers\PostController::class)->only('index', 'store', 'show', 'create');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('index', 'store');



Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'update', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('index', 'store');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'update', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('index', 'store');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'update', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('index', 'store');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'update', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('index', 'store');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'update', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('index', 'store');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'update', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('index', 'store');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'update', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('index', 'store');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'update', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('index', 'store');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'update', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('index', 'store');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'update', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('index', 'store');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'update', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('index', 'store');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'update', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('index', 'store');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'update', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('index', 'store');


Route::resource('posts', App\Http\Controllers\PostController::class)->except('edit', 'update', 'destroy');

Route::resource('comments', App\Http\Controllers\CommentController::class)->only('index', 'store');
