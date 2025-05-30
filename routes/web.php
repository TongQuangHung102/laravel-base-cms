<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

// Route khi chạy chương trình sẽ chạy vào view nào.
Route::get('/', function () {
    return view('auth.register');
});

// Route get, post có uri /register
// 1. RegisterController với class showRegistrationForm và có name Route: register. (get) --> Để hiện thị form đăng ký.
// 2. RegisterController với class register. (post) --> Để đăng ký
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
