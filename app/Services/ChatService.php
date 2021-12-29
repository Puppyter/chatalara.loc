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

    public function get(?string $time)
    {
         $time == 'null'
            ? $messages = $this->messageRepository->get(null)
            : $messages = $this->messageRepository->get($time);
         foreach ($messages as $message)
         {
             $message->name = $message->user->name;
             unset($message->user);
         }
         return $messages;
    }

    public function setTime()
    {
        return date('Y-m-d H:i:s', strtotime('-5 second'));
    }
}
