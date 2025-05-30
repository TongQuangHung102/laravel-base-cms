<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {

        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            // redirect()->back(): Chuyển hướng người dùng trở lại trang trước đó (trang form đăng ký).

            // ->withErrors($e->errors()): Gắn các thông báo lỗi validation vào session.
            // Các lỗi này sau đó có thể được truy cập trong view bằng biến $errors của Blade.

            // ->withInput(): Gắn tất cả dữ liệu đầu vào từ yêu cầu hiện tại vào session. 
            //Điều này cho phép bạn sử dụng old('field_name') trong form để tự động điền lại các giá trị mà người dùng đã nhập, giúp họ không phải nhập lại toàn bộ form khi có lỗi.
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'User',
        ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'username' => $request->username,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'role' => 'User',
        // ]);

        // 3. Đăng nhập người dùng ngay lập tức
        // Auth::login($user);


        return redirect()->route('register');
    }
}
