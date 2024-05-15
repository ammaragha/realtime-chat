<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatMessageRequest;
use App\Services\ChatMessageService;
use Illuminate\Http\Request;

class ChatMessagesController extends Controller
{
    public function __construct(private readonly ChatMessageService $chatMessageService)
    {
    }


    public function store(ChatMessageRequest $request)
    {
        return $this->chatMessageService->store($request->validated());
    }
}
