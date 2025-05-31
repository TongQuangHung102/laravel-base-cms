<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\UserController;

// Route khi chạy chương trình sẽ chạy vào view nào.
Route::get('/', function () {
    return view('home');
});

// Route get, post có uri /register
// 1. RegisterController với class showRegistrationForm và có name Route: register. (get) --> Để hiện thị form đăng ký.
// 2. RegisterController với class register. (post) --> Để đăng ký
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/admin/listuser', [UserController::class, 'index'])->name('listuser');
Route::get('/admin/detailuser/{id}', [UserController::class, 'detail'])->name('detailuser');
Route::put('/admin/updateuser/{id}', [UserController::class, 'update'])->name('updateuser');

Route::delete('/admin/deleteuser/{id}', [UserController::class, 'softDelete'])->name('deletesoftuser');
Route::get('/admin/trash', [UserController::class, 'trash'])->name('trashuser');
Route::post('/admin/restoreuser/{id}', [UserController::class, 'restore'])->name('restoreuser');
Route::delete('/admin/forcedeleteuser/{id}', [UserController::class, 'forceDelete'])->name('forceDeleteUser');
