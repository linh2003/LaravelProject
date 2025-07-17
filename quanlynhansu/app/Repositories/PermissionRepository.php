<?php
namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }
}
