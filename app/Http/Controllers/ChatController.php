<?php

namespace App\Http\Controllers;

use App\Services\ChatService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function __construct(private readonly ChatService $chatService)
    {
    }


    public function chatWith(int $id)
    {
        $chat = $this->chatService->getChatWithUser($id);
        $messages = $this->chatService->getChatMessages($chat->id);
        return Inertia::render('Chats/ChatWith', [
            "chat" => $chat,
            "messages" => $messages->items()
        ]);
    }
}
