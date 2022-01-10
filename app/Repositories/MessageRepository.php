<?php

namespace App\Repositories;

use App\Models\Message;

class MessageRepository
{
    public function create(array $data)
    {
        return Message::create($data);
    }

    public function getPrivateMessages(?string $time, int $userId)
    {
        return empty($time)
            ?Message::whereIn('recipient_id', [0, $userId])
                ->limit(20)
                ->latest()
                ->get()
            :Message::where('created_at', '>=', $time)
                ->whereIn('recipient_id',[0,$userId])
                ->latest()
                ->get();
    }

    public function getPublicMessages(?string $time, int $userId)
    {
        return empty($time)
            ?Message::where('user_id',$userId)
                ->whereNotNull('recipient_id')
                ->latest()
                ->limit(20)
                ->get()
            :Message::where('created_at', '>=', $time)
                ->where('user_id',$userId)
                ->whereNotNull('recipient_id')
                ->latest()
                ->get() ;
    }
}
