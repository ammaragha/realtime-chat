<?php

namespace App\Services;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ChatService
{

    public function __construct(private readonly Chat $chat, private readonly UserService $userService)
    {
    }

    public function getChatWithUser(int $userId): Chat
    {
        //check if user exist
        $receiver = $this->userService->read($userId);

        $ids = [auth()->user()->id, $receiver->id];

        //get chat between two users or create new
        $chat = $this->chat->where(function ($q) use ($receiver) {
            $q->where('sender_id', auth()->user()->id)->where('receiver_id', $receiver->id);
        })->orWhere(function ($q) use ($receiver) {
            $q->where('receiver_id', auth()->user()->id)->where('sender_id', $receiver->id);
        })->firstOrCreate([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $receiver->id
        ]);

        $chat->sender = auth()->user();
        $chat->receiver = $receiver;
        return $chat;
    }

    public function read(int $id): Model
    {
        return $this->chat->findOrFail($id);
    }

    public function getChatMessages(int $id): LengthAwarePaginator
    {
        return $this->read($id)->messages()->paginate(20);
    }
}
