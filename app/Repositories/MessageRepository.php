<?php

namespace App\Repositories;

use App\Models\Message;

class MessageRepository
{
    public function create(array $data)
    {
        return Message::create($data);
    }

    public function get(?string $time)
    {
        return empty($time)
            ? Message::latest()->limit(20)->get()
            : Message::where('created_at', '>=', $time)->latest()->get();
    }
}
