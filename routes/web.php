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
Route::get('/admin/listuser', [UserController::class, 'index'])->name('listuser');
Route::get('/admin/detailuser/{id}', [UserController::class, 'detail'])->name('detailuser');
Route::put('/admin/updateuser/{id}', [UserController::class, 'update'])->name('updateuser');


Route::delete('/admin/deleteuser/{id}', [UserController::class, 'softDelete'])->name('deleteSoftUser');
Route::get('/admin/trash', [UserController::class, 'trash'])->name('trashuser');
Route::post('/admin/restoreuser/{id}', [UserController::class, 'restore'])->name('restoreuser');
Route::delete('/admin/forcedeleteuser/{id}', [UserController::class, 'forceDelete'])->name('forceDeleteUser');

Route::get('/page', [PageController::class, 'index'])->name('listpage');
Route::get('/page/{id}', [PageController::class, 'show'])->name('detailpage');

Route::get('/post', [PostController::class, 'index'])->name('listpost');
Route::get('/post/{id}', [PostController::class, 'show'])->name('detailpost');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
