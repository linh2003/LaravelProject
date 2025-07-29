<?php
namespace App\Repositories;

use App\Models\System;
use App\Repositories\Interfaces\SystemRepositoryInterface;
use App\Repositories\BaseRepository;

class SystemRepository extends BaseRepository implements SystemRepositoryInterface
{
    public function __construct(System $system){
        $this->model = $system;
    }
    public function getConfig(){
        return $this->model->all(['keyword', 'content']);
    }
    
}