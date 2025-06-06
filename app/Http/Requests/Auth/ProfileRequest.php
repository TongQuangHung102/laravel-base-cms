<?php

namespace App\Http\Requests\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Role;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $userId = Auth::id();
        $user = Auth::user();

        $rules = [
            'name' => 'required|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'birthdate' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'slogan' => 'nullable|string|max:255',
            // 'password' => 'nullable|string|min:8|confirmed',
        ];
        if ($user && $user->hasRole('admin')) {
            $rules['username'] = ['required', 'string', 'max:255', Rule::unique('users')->ignore($userId)];
            $rules['email'] = ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($userId)];
        }
        return $rules;
    }
    public function messages(): array
    {
        return [
            'username.unique' => 'Tên người dùng này đã tồn tại.',
            'email.unique' => 'Email này đã tồn tại.',
        ];
    }
}
