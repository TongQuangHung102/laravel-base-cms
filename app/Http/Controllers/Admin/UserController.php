<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(2);
        return view('admin.listuser', compact('users'));
    }

    public function detail($id)
    {
        $user = User::findOrFail($id);
        return view('admin.detailuser', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);


        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string|in:user,admin',
            'gender' => 'nullable|string|in:male,female,other',
            'birthdate' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'slogan' => 'nullable|string|max:255',
            // 'password' => 'nullable|string|min:8|confirmed', 
        ]);


        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->address = $request->address;
        $user->slogan = $request->slogan;


        // if ($request->filled('password')) {
        //     $user->password = Hash::make($request->password);
        // }
        $user->save();
        return redirect()->route('listuser')->with('success', 'Người dùng đã được cập nhật thành công!');
    }
}
