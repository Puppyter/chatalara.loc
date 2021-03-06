<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatRequest;
use App\Services\ChatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function show()
    {
        return response()->view('chat');
    }

    public function getMessages(Request $request,ChatService $chatService)
    {
        return response(['messages'=>$chatService->getMessages($request->time), 'time'=>$chatService->setTime()]);
    }


    public function store(ChatRequest $request, ChatService $chatService)
    {
        $data = $request->all();
        $data["user_id"] = Auth::id();
        if ($data['recipient_id']=='null') {
            $data['recipient_id']=0;
        }
        $chatService->save($data);
        return response(['status'=>true]);
    }

}
