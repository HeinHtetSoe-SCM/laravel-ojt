<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth')->group(function () {
    // User
    Route::get('/user/logout', [UserController::class, 'logout'])->name("user.logout");
    Route::get('/user/profile', [UserController::class, 'profile'])->name("user.profile");
    Route::get('/user/edit', [UserController::class, 'edit'])->name("user.edit");
    Route::put('/user/update', [UserController::class, 'update'])->name("user.update");
    Route::get('/user/changePasswordPage', [UserController::class, 'changePasswordPage'])->name("user.changePasswordPage");
    Route::put('/user/changePassword', [UserController::class, 'changePassword'])->name("user.changePassword");

    // Post
    Route::get('/posts', [PostController::class, 'index'])->middleware('auth')->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name("posts.create");
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name("posts.edit");
    Route::post('/posts/store', [PostController::class, 'store'])->name("posts.store");
    Route::put('/posts/{id}/update', [PostController::class, 'update'])->name("posts.update");
    Route::delete('/posts/{id}', [PostController::class, 'delete'])->name("posts.delete");

    // Category
    Route::resource('categories', CategoryController::class);

    // CSV
    Route::post('/upload-file', [PostController::class, 'uploadFile'])->name('posts.import');
    Route::get('/download-file', [PostController::class, 'downloadFile'])->name('posts.export');
});

// User
Route::get('/user/register', [UserController::class, 'register'])->name("user.register");
Route::post('/user/store', [UserController::class, 'store'])->name("user.store");
Route::get('/user/login', [UserController::class, 'login'])->name("user.login");
Route::post('/user/signin', [UserController::class, 'signIn'])->name("user.signin");
