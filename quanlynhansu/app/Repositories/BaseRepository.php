<?php
namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use App\Constants\Number;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function delete($condition = []){
        $query = $this->model->newQuery();
        foreach ($condition as $k => $it) {
            $query->where($it[0], $it[1], $it[2]);
        }
        return $query->delete();
        // dd($ret->toSql());
    }
    public function update($id, $payload){
        $query = $this->findById($id);
        $query->fill($payload);
        $query->save();
        return $query;
    }
    public function updateWhereIn($column, $value, $payload){
        $query = $this->model->whereIn($column, $value);
        return $query->update($payload);
    }
    public function updateCondition($condition, $payload){
        $query = $this->model->newQuery();
        foreach ($condition as $key => $val) {
            $query->where($val[0],$val[1],$val[2]);
        }
        return $query->update($payload);
    }
    public function findByCondition($select = ['*'], $condition = [], $joins = [], $first = false, $relations = [], $orderBy = ['id', 'DESC']){
        $query = $this->model->select($select)->with($relations);
        foreach ($joins as $join) {
            $query->join($join[0], $join[1], $join[2], $join[3]);
        }
        $query->where(function($query) use ($condition){
            if (isset($condition['where']) && count($condition['where'])) {
                foreach ($condition['where'] as $k => $it) {
                    $query->where($it[0], $it[1], $it[2]);
                }
            }
            if (isset($condition['orWhere']) && count($condition['orWhere'])) {
                foreach ($condition['orWhere'] as $k => $it) {
                    $query->orWhere($it[0], $it[1], $it[2]);
                }
            }
        });
        $query->orderBy($orderBy[0], $orderBy[1]);
        // dd($query->toSql());
        if (!$first) {
            return $query->get();
        }
        return $query->first();
    }
    public function findById($id, $select=['*'], $relation = []){
        return $this->model->select($select)->with($relation)->findOrFail($id);
    }

    public function getAll($select = ['*'], $relation = [], $orderBy = ['id', 'DESC']){
        return $this->model->select($select)->with($relation)->orderBy($orderBy[0], $orderBy[1])->get();
    }
    public function syncData($model, $relation, $payload){
        return $model->{$relation}()->sync($payload);
    }
    public function createPivot($model, $relation, $payload){
        return $model->{$relation}()->attach($model->id, $payload);
    }
    public function create($payload)
    {
        $query = $this->model->create($payload);
        return $query->fresh();
    }
    public function getData(
		$select = ['*'], 
		$condition = [], 
		$counter = false, 
		$join = [], 
		$extend = '', 
		$rawQuery = [], 
		$relations = [], 
		$orderBy = ['id', 'DESC'], 
		$groupBy = [], 
		$paginate = Number::PAGINATION
    ){
        $query = $this->model->select($select)
        ->keyword($condition['keyword'] ?? null)
        ->status('publish', $condition['publish'] ?? null)
        ->relation($relations ?? null)
        ->customWhere($condition['where'] ?? null)
        ->customWhereBetween($condition['whereBetween'] ?? null)
        ->customWhereRaw($rawQuery ?? null)
        ->customJoin($join ?? null)
        ->customGroupBy($groupBy ?? null)
        ->customOrderBy($orderBy ?? null);
        $total = $query->get()->count();
        if (isset($condition['perpage']) && !empty($condition['perpage'])) {
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
            $url = !empty($extend) ? URL::to('/').'/'.$extend :'';
           return $query->paginate($paginate)->withQueryString()->withPath($url);
        }
    }
}
