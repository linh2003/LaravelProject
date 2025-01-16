<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    // protected $model;
    public function __construct(User $u){
        $this->model = $u;
    }
    public function getDataPagination(
        $column=['*'],
        $condition=[],
        $join=[],
        $perPage=20,
        $extend=[],
        $relations=[],
        $rawQuery=[],
        $pagination=true,
        $orderBy=['id','DESC']
    ){
        $query = $this->model->select($column)->where(function($query) use ($condition){
            if (isset($condition['keyword']) && !empty($condition['keyword'])) {
                $query->where('name','LIKE','%'.$condition['keyword'].'%')
                ->orWhere('email','LIKE','%'.$condition['keyword'].'%')
                ->orWhere('phone','LIKE','%'.$condition['keyword'].'%')
                ->orWhere('address','LIKE','%'.$condition['keyword'].'%');
            }
            
        });
        if (isset($condition['publish']) && $condition['publish'] != -1) {
            $query->where('publish','=',$condition['publish']);
        }
        if (isset($condition['role']) && !empty($condition['role'])) {
            $query->where('role','=',$condition['role']);
        }
        $query->orderBy($orderBy[0],$orderBy[1]);
        if(!empty($join)){
            $query->join(...$join);
        }
        if(!$pagination){
            return $query->count();
        }
        // echo $query->toSql();die();
        return $query->paginate($perPage)->withQueryString()->withPath('/'.$extend['path']);
    }
    
}


