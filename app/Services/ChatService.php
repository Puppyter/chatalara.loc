<?php

namespace App\Services;

use App\Repositories\MessageRepository;

class ChatService
{
    private $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function save($data)
    {
        return $this->messageRepository->create($data);
    }

    public function get()
    {
        $messages = $this->messageRepository->get()->items();
        foreach ($messages as $message)
        {
            $message['name'] = $message->user->name;
        }
        return $messages;
    }
}
