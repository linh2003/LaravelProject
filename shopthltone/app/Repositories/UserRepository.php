<?php
namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    // protected $model;
    public function __construct(User $user){
        $this->model = $user;
    }
    public function getUser(
        $select = ['*'],
        $condition = [],
        $counter = false,
        $join = [],
        $orderBy = ['id', 'DESC'],
        $paginate = 20
    ){
        $query = $this->model->select($select)
        ->keyword($condition['keyword'] ?? null)
        ->orWhere('email', 'LIKE', '%'.$condition['keyword'].'%')
        ->orWhere('phone', 'LIKE', '%'.$condition['keyword'].'%')
        ->orWhere('address', 'LIKE', '%'.$condition['keyword'].'%')
        ->status('status', $condition['publish'] ?? null)
        ->customJoin($join ?? null)
        ->customOrderBy($orderBy ?? null);
        $total = $query->get()->count();
        if (isset($condition['perpage']) && !empty($condition['perpage'])) {
            // dd($condition['perpage']);
            $perpage = intval($condition['perpage']);
            if(is_integer($perpage) && $perpage){
                $arr = config('apps.general.paginate');
                if(in_array($perpage, $arr)){
                    $paginate = $perpage;
                }else{
                    $paginate = $arr[0];
                }
            }else{
                $paginate = $total;
            }
        }
        // dd($query->toSql());
        if ($counter) {
            return $total;
        }else{
           return $query->paginate($paginate)->withQueryString();
        }
    }
    // public function getAll(array $select = [], array $condition = [], $counter = false, array $join = [], string $extern = '', array $orderBy = ['id', 'DESC'], $paginate = 20){
    //     $query = $this->model->select($select)->where(function($query) use ($condition){
    //         $query->where('name', 'LIKE', '%'.$condition['keyword'].'%')
    //         ->orWhere('email', 'LIKE', '%'.$condition['keyword'].'%')
    //         ->orWhere('phone', 'LIKE', '%'.$condition['keyword'].'%')
    //         ->orWhere('address', 'LIKE', '%'.$condition['keyword'].'%');
    //     });
    //     if (isset($condition['publish']) && !empty($condition['publish'])) {
    //         $query->where('status', '=', $condition['publish']);
    //     }
    //     $total = $query->get()->count();
    //     if (isset($condition['perpage']) && !empty($condition['perpage'])) {
    //         // dd($condition['perpage']);
    //         $perpage = intval($condition['perpage']);
    //         if(is_integer($perpage) && $perpage){
    //             $arr = config('apps.general.paginate');
    //             if(in_array($perpage, $arr)){
    //                 $paginate = $perpage;
    //             }else{
    //                 $paginate = $arr[0];
    //             }
    //         }else{
    //             $paginate = $total;
    //         }
    //     }
    //     $query->orderBy($orderBy[0], $orderBy[1]);
    //     // dd($query->toSql());
    //     if ($counter) {
    //         return $total;
    //     }else{
    //        return $query->paginate($paginate)->withQueryString();
    //     }
    // }
}
