<?php

namespace App\Services;

use App\Repositories\MessageRepository;
use Illuminate\Support\Facades\Auth;

class ChatService
{
    private $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function save(array $data)
    {
        /** @var ActivityService $activityService */
        $activityService = app(ActivityService::class);
        $activityService->changeLastActivity(Auth::id());
        return $this->messageRepository->create($data);
    }


    public function getMessages(?string $time)
    {
        /** @var ActivityService $activityService */
        $activityService = app(ActivityService::class);
         empty($time)
            ? $messages = $this->messageRepository->getPublicMessages(null,Auth::id())
             ->merge($this->messageRepository->getPrivateMessages(null,Auth::id()))
            : $messages = $this->messageRepository->getPublicMessages($time,Auth::id())
             ->merge($this->messageRepository->getPrivateMessages($time,Auth::id()));
         foreach ($messages as $message) {
             $message->name = $message->user->name;
             unset($message->user);
         }
        $activityService->changeLastActivity(Auth::id());
         return $messages;
    }

    public function setTime()
    {
        return date('Y-m-d H:i:s', strtotime('-5 second'));
    }
}
