<?php

namespace App\Services;

use App\Repositories\ProfileRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;

class ProfileService
{
    private $profileRepository;
    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }
    public function updateProfile(User $user, array $data): bool
    {
        return $this->profileRepository->update($user, $data);
    }
}
