<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Auth\LoginController;

// Route khi chạy chương trình sẽ chạy vào view nào.
Route::get('/', function () {
    return view('frontend.home');
})->name('home');

// Route get, post có uri /register
// 1. RegisterController với class showRegistrationForm và có name Route: register. (get) --> Để hiện thị form đăng ký.
// 2. RegisterController với class register. (post) --> Để đăng ký
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Route put: cập nhập toàn bộ thông tin; Route patch: cập nhập một phần 
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/listuser', [UserController::class, 'index'])->name('users.listUser');
    Route::get('/detailuser/{id}', [UserController::class, 'detail'])->name('users.detailUser');
    Route::put('/updateuser/{id}', [UserController::class, 'update'])->name('users.updateUser');

    Route::delete('/deleteuser/{id}', [UserController::class, 'softDelete'])->name('users.deleteSoftUser');
    Route::get('/listtrash', [UserController::class, 'trash'])->name('users.trashUser');
    Route::post('/restoreuser/{id}', [UserController::class, 'restore'])->name('users.restoreUser');
    Route::delete('/forcedeleteuser/{id}', [UserController::class, 'forceDelete'])->name('users.forceDeleteUser');
});


Route::get('/page', [PageController::class, 'index'])->name('pages.index');
Route::get('/page/{id}', [PageController::class, 'show'])->name('pages.show');

Route::get('/post/my-posts', [PostController::class, 'myPosts'])->name('profile.my-posts');
Route::get('/post/my-posts/{id}', [PostController::class, 'myPostShow'])->name('profile.my-post-show');
Route::put('/post/update-post/{id}', [PostController::class, 'updatePost'])->name('profile.update-post');
Route::get('/post/add-post', [PostController::class, 'showAddForm'])->name('profile.show-add-form');
Route::post('/post/add-post', [PostController::class, 'store'])->name('profile.store');
Route::delete('post/deleteuser/{id}', [PostController::class, 'forceDelete'])->name('profile.forceDelete');

Route::get('/post', [PostController::class, 'index'])->name('posts.index');
Route::get('/post/{id}', [PostController::class, 'show'])->name('posts.show');
Route::post('/comment', [CommentController::class, 'store'])->name('comments.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.profile');
Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
