<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\ProfileRequest;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileService;


    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function profile(): View
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }


    public function updateProfile(ProfileRequest $request)
    {
        $userData = $request->validated();
        $user = Auth::user();
        $this->profileService->updateProfile($user, $userData);

        return redirect()->route('profile')->with('success', 'Cập nhật thông tin thành công!');
    }
}
