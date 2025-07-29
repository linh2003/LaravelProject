<?php
namespace App\Repositories;

use App\Models\Ward;
use App\Repositories\Interfaces\WardRepositoryInterface;
use App\Repositories\BaseRepository;

class WardRepository extends BaseRepository implements WardRepositoryInterface
{
    public function __construct(Ward $ward){
        $this->model = $ward;
    }
    
}