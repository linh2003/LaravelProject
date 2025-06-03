<?php
namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function __construct(Role $role){
        $this->model = $role;
    }
    public function getRoles(string $col = 'id', string $direction = 'DESC'){
        return $this->model->orderBy($col, $direction)->get();
    }
}