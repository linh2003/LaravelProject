<?php
namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    public function __construct(Model $model){
        $this->model = $model;
    }
    public function breadcrumb($model, $lft, $rgt, $languageId){
        $condition = [
            ['lft', '<=', $lft],
            ['rgt', '>=', $rgt],
        ];
        $query = $model->select(['*'])->with('languages', function($query) use ($languageId){
            $query->where('language_id', '=', $languageId);
        })->where(function($query) use ($condition){
            foreach ($condition as $k => $val) {
                $query->where($val[0], $val[1], $val[2]);
            }
        });
        return $query->get();
    }
    public function deleteCondition($condition = []){
        $query = $this->model->where(function($query) use ($condition){
            if (isset($condition['module_id'])) {
                $query->whereIn('module_id', $condition['module_id']);
            }
            if (isset($condition['where'])) {
                foreach ($condition['where'] as $val) {
                    $query->where($val[0], $val[1], $val[2]);
                }
            }
        });
        // dd($query->toSql());
        return $query->delete();
    }
    public function syncData($model,$payload=[],$relation=''){
        return $model->{$relation}()->sync($payload);
    }
    public function destroyCondition($select, $condition, $join){
        $query = $this->model->where(function($query) use ($condition){
            if (isset($condition['wherein'])) {
                foreach ($condition['wherein'] as $key => $value) {
                    $query->whereIn($key, $value);
                }
            }
            if (isset($condition['where'])) {
                foreach ($condition['where'] as $val) {
                    $query->where($val[0], $val[1], $val[2]);
                }
            }
        });
        // dd($query->toSql());
        return $query->forceDelete();
    }
    public function destroy($id){
        $model = $this->findById($id);
        $model->forceDelete();
        return $model;
    }
    public function remove($id){
        $model = $this->findById($id);
        $model->delete();
        return $model;
    }
    public function upsertData($payload, $unique, $update){
        return $this->model->upsert($payload, $unique, $update);
    }
    public function createBatch($payload){
        return $this->model->insert($payload);
    }
    /**
     * Summary of createBatch
     * @param model is collection
     * @param payload is two dimensional
     * @return void
     */
    public function createMany($model, $payload, $relation){
        return $model->{$relation}()->createMany($payload);
    }
    /**
     * Summary of createPivot
     * @param mixed $model thường sử dụng findById để return collection
     * @param array $payload [51,50,49]
     * @param mixed $relation mối quan hệ khai báo trong model
     */
    public function createPivot($model,$payload=[],$relation=''){
        return $model->{$relation}()->attach($model->id, $payload);
    }
    public function create($payload = []){
        $query = $this->model->create($payload);
        return $query->fresh();
    }
    /**
     * Summary of updateByCondition
     * @param array $condition([[key1, operator1, value1])
     * @param array $column(key, value)
     * @return void
     */
    public function updateByCondition(array $condition = [], array $payload = []){
        $query = $this->model->newQuery();
        $query->where(function($query) use ($condition){
            foreach ($condition as $val) {
                $query->where($val[0], $val[1], $val[2]);
            }
        });
        $query = $query->update($payload);
        // dd($query->toSql());
        return $query;
    }
    /**
     * Summary of update
     * @param mixed $id
     * @param mixed $payload - dang array(column => value) gia tri can update
     * use fill() gan gia tri vao column nhung chua save vao DB neu muon save can goi save()
     * @return Model|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function update($id, $payload = []){
        $model = $this->findById($id);
        $model->fill($payload);
        // dd($model->toSql());
        $model->save();
        
        return $model;
    }
    public function updateWhereIn(string $whereInField, array $whereIn = [], array $condition = []){
        return $this->model->whereIn($whereInField, $whereIn)->update($condition);
    }
    public function findById($id = '', $column = ['*'], $relation = []){
        return $this->model->select($column)->with($relation)->findOrFail($id);
        // dd($query->toSql());
        // return $query;
    }
    public function findByCondition(array $select = ['*'], array $condition = [], array $join = [], $groupBy = [], $relations = []){
        $query = $this->model->select($select)->with($relations)
        ->where(function($query) use ($condition){
            foreach ($condition as $k => $val) {
                $query->where($val[0], $val[1], $val[2]);
            }
        });
        foreach ($join as $key => $value) {
            $query->join($value[0], $value[1], $value[2], $value[3]);
        }
        if (count($groupBy)) {
            foreach ($groupBy as $key => $g) {
                $query->groupBy($g);
            }
        }
        // dd($query->toSql());
        return $query->get();
    }
    public function all(array $select = ['*'], array $sort = ['id', 'DESC']){
        return $this->model->select($select)->orderBy($sort[0], $sort[1])->get();
    }
    public function getData(array $select = ['*'], array $condition = [], $counter = false, array $join = [], string $extend = '', array $rawQuery = [], array $relations = [], array $orderBy = ['id', 'DESC'], array $groupBy = [], $paginate = 4){
        $query = $this->model->select($select)
        ->keyword($condition['keyword'] ?? null)
        ->status('publish', $condition['publish'] ?? null)
        ->relationCount($relations ?? null)
        ->customWhere($condition['where'] ?? null)
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
        // return $query->get();
    }
}
