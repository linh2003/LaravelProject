<?php
namespace App\Traits;

trait QueryScopes{

	public function scopeKeyword($query,$keyword)
	{
		if (!empty($keyword)) {
            $query->where('name','LIKE','%'.$keyword.'%');
        }
        return $query;
	}
	public function scopePublish($query,$publish)
	{
		if (!empty($publish)) {
            $query->where('publish','=',$publish);
        }
        return $query;
	}
	public function scopeCustomWhere($query,$where=[])
	{
		if(!empty($where)){
            foreach ($where as $key => $val) {
                $query->where($val[0],$val[1],$val[2]);
            }
        }
        return $query;
	}
	public function scopeCustomWhereRaw($query,$rawQuery=[])
	{
		if(!empty($rawQuery)){
            foreach ($rawQuery as $key => $val) {
                $query->whereRaw($val[0],$val[1]);
            }
        }
        return $query;
	}
	public function scopeRelationCount($query,$relations=[])
	{
		if(count($relations) > 0){
            foreach ($relations as $key => $relation) {
                $query->withCount($relation);
            }
        }
        return $query;
	}
	public function scopeRelation($query,$relation)
	{
		if(count($relation) > 0){
            foreach ($relation as $key => $it) {
                $query->with($it);
            }
        }
        return $query;
	}
	public function scopeCustomJoin($query,$join)
	{
		if(count($join) > 0){
            foreach ($join as $key => $val) {
                $query->join($val[0],$val[1],$val[2],$val[3]);
            }
        }
        return $query;
	}
	public function scopeCustomGroupBy($query,$groupBy)
	{
		if(!empty($groupBy)){
            $query->groupBy($groupBy);
        }
        return $query;
	}
	public function scopeCustomOrderBy($query,$orderBy)
	{
		if(!empty($orderBy)){
            $query->orderBy($orderBy[0],$orderBy[1]);
        }
        return $query;
	}
}
