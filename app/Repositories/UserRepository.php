<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create(array $data)
    {
        return User::create($data);
    }

    public function find(int $userId)
    {
        return User::find($userId);
    }

    public function getAllActive()
    {
        return User::where('last_activity','>',now()->subMinutes(15))->get(['name','avatar']);
    }

    public function update(int $userId, array $data)
    {
        return User::find($userId)->update($data);
    }
}
