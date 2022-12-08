<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name("home");

// Post
Route::get('/posts', [PostController::class, 'index'])->name("posts.index");
Route::get('/posts/create', [PostController::class, 'create'])->name("posts.create");
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name("posts.edit");
Route::post('/posts/store', [PostController::class, 'store'])->name("posts.store");
Route::put('/posts/{id}/update', [PostController::class, 'update'])->name("posts.update");
Route::delete('/posts/{id}', [PostController::class, 'delete'])->name("posts.delete");

// Category
Route::resource('categories', CategoryController::class);

Route::post('/upload-file',[PostController::class,'uploadFile'])->name('posts.import');
Route::get('/download-file',[PostController::class,'downloadFile'])->name('posts.export');