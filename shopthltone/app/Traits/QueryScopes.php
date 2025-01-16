<?php
namespace App\Traits;

trait QueryScopes
{
    public function scopeKeyword($query,$keyword){
        if (!empty($keyword)) {
            $query->where('name','LIKE','%'.$keyword.'%');
        }
        return $query;
    }
    public function scopePublish($query,$publish){
        if (!empty($publish)) {
            $query->where('publish','=',$publish);
        }
        return $query;
    }
    public function scopeCustomWhere($query,$where=[]){
        if (!empty($where)) {
            foreach ($where as $k => $it) {
                $query->where($it[0],$it[1],$it[2]);
            }
        }
        return $query;
    }
    public function scopeCustomWhereRaw($query,$rawQuery=[]){
        if (!empty($rawQuery)) {
            foreach ($rawQuery as $k => $it) {
                $query->whereRaw($it[0],$it[1]);
            }
        }
        return $query;
    }
    public function scopeRelationCount($query,$relations=[]){
        if (count($relations) > 0) {
            foreach ($relations as $k => $relation) {
                $query->withCount($relation);
            }
        }
        return $query;
    }
    public function scopeCustomJoin($query,$join){
        if (count($join) > 0) {
            foreach ($join as $k => $it) {
                $query->join($it[0],$it[1],$it[2],$it[3]);
            }
        }
        return $query;
    }
    public function scopeRelation($query,$relation){
        if (count($relation) > 0) {
            foreach ($relation as $k => $it) {
                $query->with($it);
            }
        }
        return $query;
    }
    public function scopeCustomGroupBy($query,$groupBy){
        if (!empty($groupBy)) {
            $query->groupBy($groupBy);
        }
        return $query;
    }
    public function scopeCustomOrderBy($query,$orderBy){
        if (!empty($orderBy)) {
            $query->orderBy($orderBy[0],$orderBy[1]);
        }
        return $query;
    }
}
