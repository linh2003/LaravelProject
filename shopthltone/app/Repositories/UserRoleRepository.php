<?php
namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\UserRoleRepositoryInterface;
use App\Repositories\BaseRepository;

class UserRoleRepository extends BaseRepository implements UserRoleRepositoryInterface
{
    // protected $model;
    public function __construct(Role $role){
        $this->model = $role;
    }
    public function getDataPagination(
        $column=['*'],
        $condition=[],
        $join=[],
        $perPage=20,
        $extend=[],
        $relation=[],
        $rawQuery=[],
        $pagination=true,
        $orderBy=['DESC','id'],
    ){
        $query = $this->model->select($column)->where(function($query) use ($condition){
            if (isset($condition['keyword']) && !empty($condition['keyword'])) {
                $query->where('name','LIKE','%'.$condition['keyword'].'%')
                ->orWhere('description','LIKE','%'.$condition['keyword'].'%');
            }
        });
        switch (strtoupper($orderBy[0])) {
            case 'ASC':
                $query->orderBy($orderBy[1]);
                break;
            
            default:
            $query->orderByDesc($orderBy[1]);
                break;
        }
        
        
        if(!empty($join)){
            $query->join(...$join);
        }
        return $query->paginate($perPage)->withQueryString()->withPath('/'.$extend['path']);
    }
    
}


