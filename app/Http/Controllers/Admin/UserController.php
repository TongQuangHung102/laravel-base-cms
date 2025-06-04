<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Services\UserService;
use App\Http\Requests\Admin\UserRequest;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
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

    public function update(UserRequest $request, $id)
    {
        $this->userService->update($request->validated(), $id);
        return redirect()->route('listuser')->with('success', 'Người dùng đã được cập nhật thành công!');
    }

    public function softDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Gọi soft delete
        return redirect()->route('listuser')->with('success', 'Người dùng đã được xóa mềm thành công!');
    }

    public function trash()
    {
        $users = User::onlyTrashed()->paginate(2);
        return view('admin.trashuser', compact('users'));
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('trashuser')->with('success', 'Khôi phục người dùng thành công!');
    }

    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('trashuser')->with('success', 'Người dùng đã bị xóa vĩnh viễn khỏi hệ thống!');
    }
}
