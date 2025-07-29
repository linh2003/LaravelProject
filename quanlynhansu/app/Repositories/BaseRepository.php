<?php
namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

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
    public function findByCondition($select = ['*'], $condition = []){
        $query = $this->model->select($select)->where(function($query) use ($condition){
            if (isset($condition['where']) && count($condition['where'])) {
                foreach ($condition['where'] as $k => $it) {
                    $query->where($it[0], $it[1], $it[2]);
                }
            }
        });
        return $query->get();
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
        $columns = ['*'],
        $relation = [],
        $pagination = 2,
        $orderBy = ['id', 'DESC']
    ){
        $query = $this->model->select($columns)
        ->with($relation)
        ->orderBy($orderBy[0], $orderBy[1])
        ->paginate($pagination);
        return $query;
    }
}
