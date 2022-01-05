<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class ActivityService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function changeActive(int $userId, string $time)
    {
        $this->userRepository->update($userId,['last_activity'=>$time]);
    }

    public function getAllActiveUsers()
    {
        return $this->userRepository->getAllActive();
    }
    public function changeLastActivity(int $userId)
    {
       return $this->userRepository->update($userId,['last_activity'=>date('Y-m-d H:i:s')]);
    }
}
