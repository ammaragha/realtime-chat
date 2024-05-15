<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function index()
    {
        return Inertia::render('Users/Index', [
            "users" => $this->userService->index()
        ]);
    }

    public function saveToken(Request $request)
    {
        return $this->userService->saveToken(auth()->user()->id, $request->input('token'));
    }
}
