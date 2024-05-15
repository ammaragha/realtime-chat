<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

class HomeService
{

    public function __construct(private readonly UserService $userService)
    {
    }

    public function getUsers(int $perPage = 20): LengthAwarePaginator
    {
        return $this->userService->index($perPage, ['id', 'name', 'email']);
    }
}
