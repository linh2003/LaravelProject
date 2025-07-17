<?php
namespace App\Repositories;

use App\Models\Module;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\ModuleRepositoryInterface;

class ModuleRepository extends BaseRepository implements ModuleRepositoryInterface
{
    public function __construct(Module $module)
    {
        $this->model = $module;
    }
}
