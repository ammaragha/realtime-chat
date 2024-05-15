<?php

namespace App\Http\Requests;

use App\Models\Chat;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ChatMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "message" => ['required', 'string'],
            "chat_id" => ['required', 'integer', Rule::exists('chats', 'id')->where(function ($query) {
                $query->where('sender_id', Auth::id())->orWhere('receiver_id', Auth::id());
            })],
            "receiver_id" => ['required', "integer", Rule::exists('users', 'id')]
        ];
    }
}
