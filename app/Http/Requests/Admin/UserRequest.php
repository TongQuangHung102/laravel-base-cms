<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @method \Illuminate\Routing\Route|null route(string|null $key = null)
 */
class UserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route('id');

        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|string|in:user,admin',
            'gender' => 'nullable|string|in:male,female,other',
            'birthdate' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'slogan' => 'nullable|string|max:255',
            // 'password' => 'nullable|string|min:8|confirmed',
        ];
    }
}
