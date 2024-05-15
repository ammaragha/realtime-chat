<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    public function __construct(private readonly User $user)
    {
    }

    public function index(int $perPage = 20, array $cols = ['*']): LengthAwarePaginator
    {
        return $this->user->select($cols)->paginate($perPage);
    }

    public function read(int $id): User
    {
        return $this->user->findOrFail($id);
    }

    public function saveToken(int $id, string|null $token): User
    {
        $user = $this->read($id);
        $user->update(['fcn_token' => $token]);
        return $user;
    }
}
