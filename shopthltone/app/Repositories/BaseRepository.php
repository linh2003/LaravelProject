<?php
namespace App\Repositories;

use App\Models\Base;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    public function __construct(Model $model){
        $this->model = $model;
    }
    public function delete($id){
        return $this->findByID($id)->delete();
    }
    public function forceDelete($id=0){
        return $this->findByID($id)->forceDelete();
    }
    public function forceDeleteByCondition($condition=[]){
        $query = $this->model->newQuery();
        foreach ($condition as $key => $val) {
            $query->where($val[0],$val[1],$val[2]);
        }
        return $query->forceDelete();
    }

    public function updateByWhereIn($whereInField, $whereIn=[], $payload=[]){
        $query = $this->model->whereIn($whereInField,$whereIn)->update($payload);
        return $query;
    }

    public function update($id,$payload){
        $m = $this->findByID($id);
        return $m->update($payload);
    }

    public function findByID(
        int $id,
        $column=['*'],
        $relation=[]
    )
    {
        return $this->model->select($column)->with($relation)->findOrFail($id);
    }

    public function updateByWhere($condition=[],$payload=[]){
        $query = $this->model->newQuery();
        foreach ($condition as $key => $val) {
            $query->where($val[0],$val[1],$val[2]);
        }
        return $query->update($payload);
    }
    public function createBatch($payload=[]){
        return $this->model->insert($payload);
    }
    public function createPivot($model,$payload=[],$relation=''){
        return $model->languages()->attach($model->id,$payload);
    }

    public function create($payload=[]){
        $ret = $this->model->create($payload);
        return $ret->fresh();
    }

    public function getAll($orderBy=['id','DESC'],$relation=[]){
        if (isset($orderBy[1]) && $orderBy[1]=='ASC') {
            return $this->model->with($relation)->get();
        }
        return $this->model->with($relation)->orderByDesc($orderBy[0])->get();
    }
    public function getDataPagination(
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


