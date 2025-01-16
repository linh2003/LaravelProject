<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user){
        $this->model = $user;
    }
    public function getUsers(
        $column=['*'],
        $condition=[],
        $join=[],
        $perPage=0,
        $extern=[],
        $relation=[],
        $rawQuery=[],
        $count=false,
        $orderBy=['id','DESC']
    )
    {
        $query = $this->model->select($column);
        $query->keyword($condition['keyword']??null)
        ->orWhere('email','LIKE','%'.$condition['keyword'].'%')
        ->orWhere('phone','LIKE','%'.$condition['keyword'].'%')
        ->orWhere('address','LIKE','%'.$condition['keyword'].'%')
        ->publish($condition['publish']??null)
        ->customWhere($condition['where']??null)
        ->customWhereRaw($rawQuery['whereRaw']??null)
        ->relationCount($relation??null)
        ->customJoin($join??null)
        ->customGroupBy($extern['groupBy']??null)
        ->customOrderBy($orderBy??null);
        if($count){
            return $query->get()->count();
        }
        return $query->paginate($perPage)->withQueryString()->withPath('/'.$extern['path']);
    }
    
}