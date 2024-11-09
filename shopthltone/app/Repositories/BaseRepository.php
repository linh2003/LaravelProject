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
    public function getAll($orderBy=['ASC','id']){
        if($orderBy[0] == 'DESC'){
            return $this->model->orderByDesc($orderBy[1])->get();
        }
        return $this->model->all();
    }
    public function getCountByCondition($condition=[],$operator='=',$join=[]){
        $query = $this->model->where(function($query) use ($condition,$operator){
            foreach ($condition as $key => $val) {
                $query->where($key,$operator,$val);
            }
        });
        // if(!empty($join)){
        //     $query->join(...$join);
        // }
        if(isset($join) && is_array($join) && count($join)){
            foreach ($join as $key => $val) {
                $query->join($val[0],$val[1],$val[2],$val[3]);
            }
        }
        return $query->count();
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
        $query = $this->model->select($column);
        $query->keyword($condition['keyword']??null)
            ->publish($condition['publish']??null)
            ->customWhere($condition['where']??null)
            ->customWhereRaw($rawQuery['whereRaw']??null)
            ->relationCount($relations??null)
            ->customJoin($join??null)
            ->customGroupBy($extend['groupBy']??null)
            ->customOrderBy($orderBy??null);
        
        if(!$pagination){
            return $query->get()->count();
        }
        
        return $query->paginate($perPage)->withQueryString()->withPath('/'.$extend['path']);
    }
    
    public function create($payload=[]){
        $ret = $this->model->create($payload);
        return $ret->fresh();
    }
    public function update($id,$payload=[]){
        $m = $this->findByID($id);
        return $m->update($payload);
    }
    public function updateByWhereIn(string $whereInField='',array $whereIn=[],array $payload=[]){
        $query = $this->model->whereIn($whereInField,$whereIn)->update($payload);
        return $query;
    }
    public function updateByWhere($condition=[],$payload=[]){
        $query = $this->model->newQuery();
        foreach ($condition as $key => $val) {
            $query->where($val[0],$val[1],$val[2]);
        }
        return $query->update($payload);
    }
    public function delete($id){
        return $this->findByID($id)->delete();
    }
    public function forceDelete(int $id=0){
        return $this->findByID($id)->forceDelete();
    }
    public function findByID(
        int $id,
        $column=['*'],
        $relation=[]
    ){
        return $this->model->select($column)->with($relation)->findOrFail($id);
    }
    public function createPivot($model,$payload=[],$relation=''){
        return $model->languages()->attach($model->id,$payload);
    }
}


