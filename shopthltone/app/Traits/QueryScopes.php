<?php
namespace App\Traits;
trait QueryScopes
{
    public function scopeKeyword($query, $keyword){
        if (!empty($keyword)) {
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        }
        return $query;
    }
    public function scopeStatus($query, $statusCol, $statusVal){
        if (!empty($statusVal)) {
            $query->where($statusCol, '=', $statusVal);
        }
        return $query;
    }
    public function scopeCustomWhere($query, $where = []){
        if (!empty($where) && count($where)) {
            foreach ($where as $k => $it) {
                $query->where($it[0], $it[1], $it[2]);
            }
        }
        return $query;
    }
    public function scopeCustomJoin($query, $join){
        if (is_array($join) && count($join)) {
            foreach ($join as $k => $val) {
                $query->join($val[0], $val[1], $val[2], $val[3]);
            }
        }
        return $query;
    }
    public function scopeCustomOrderBy($query, $orderBy){
        if (is_array($orderBy) && count($orderBy)) {
            $query->orderBy($orderBy[0], $orderBy[1]);
        }
        return $query;
    }
    public function scopeRelationCount($query,$relations=[]){
        if (count($relations) > 0) {
            foreach ($relations as $k => $relation) {
                $query->withCount($relation);
            }
        }
        // dd($query->toSql());
        return $query;
    }
    public function scopeCustomWhereRaw($query, $rawInput = []){
        if (count($rawInput)) {
            foreach ($rawInput as $key => $val) {
                $query->whereRaw($val[0], $val[1]);
            }
        }
        return $query;
    }
    public function scopeCustomGroupBy($query, $groupBy){
        if(!empty($groupBy)){
            $query->groupBy($groupBy);
        }
        return $query;
    }
}
