<?php

namespace App\Services;

use App\Models\ChatMessage;
use App\Notifications\SendMessageNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatMessageService
{

    public function __construct(private readonly ChatMessage $chatMessage, private readonly UserService $userService)
    {
    }


    /**
     * @throws \Exception
     */
    public function store(array $data): Model
    {
        // start transaction
        try {
            DB::beginTransaction();
            $data['user_id'] = Auth::user()->id;
            $message = $this->chatMessage->create($data);
            $this->sendMessageTo($data['receiver_id'], $message);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }

        return $message;
    }

    public function sendMessageTo(int $userId, ChatMessage $chatMessage): void
    {
        $this->userService->read($userId)->notify(new SendMessageNotification($chatMessage));
    }
}
