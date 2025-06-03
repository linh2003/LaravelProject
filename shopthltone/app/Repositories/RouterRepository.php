<?php
namespace App\Repositories;

use App\Models\Router;
use App\Repositories\Interfaces\RouterRepositoryInterface;
use App\Repositories\BaseRepository;

class RouterRepository extends BaseRepository implements RouterRepositoryInterface
{
    public function __construct(Router $router){
        $this->model = $router;
    }
}