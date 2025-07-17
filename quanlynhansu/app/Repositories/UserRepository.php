<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
