<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    // Hàm này được sử dụng để xác định xem người dùng hiện tại có được phép thực hiện request này hay không (quyền truy cập/ủy quyền).
    // Với chức năng Register nên return là true.
    public function authorize(): bool
    {
        return true;
    }

    // Hàm này định nghĩa các quy tắc xác thực (validation rules) sẽ được áp dụng cho dữ liệu đầu vào của request.
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    // Hàm này cho phép bạn tùy chỉnh các thông báo lỗi validation mặc định của Laravel.
    public function messages(): array
    {
        return [
            'name.required' => 'Tên không được để trống.',
            'username.required' => 'Tên đăng nhập không được để trống.',
            'username.unique' => 'Tên đăng nhập đã tồn tại.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ];
    }
}
