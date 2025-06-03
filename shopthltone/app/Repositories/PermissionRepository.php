<?php
namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function __construct(Permission $permission){
        $this->model = $permission;
    }
    public function getPermissions(string $col = 'id', string $direction = 'DESC'){
        return $this->model->orderBy($col, $direction)->get();
    }
}