<?php
namespace App\Repositories;

use App\Models\Attribute;
use App\Repositories\Interfaces\AttributeRepositoryInterface;
use App\Repositories\BaseRepository;

class AttributeRepository extends BaseRepository implements AttributeRepositoryInterface
{
    public function __construct(Attribute $attribute){
        $this->model = $attribute;
    }
    public function loadAttribute($select = [], array $condition = [], $whereIn = '', array $join = []){
        if (count($select) == 0) {
            $select = [
                'id',
                'tb2.name',
            ];
        }
        if (count($join) == 0) {
            $join = [['attribute_language as tb2', 'attributes.id', '=', 'tb2.attribute_id']];
        }
        $query = $this->model->select($select);
        $query->whereIn('id', $whereIn);
        foreach ($join as $k => $val) {
            $query = $query->join($val[0], $val[1], $val[2], $val[3]);
        }
        foreach ($condition as $key => $value) {
            $query = $query->where($value[0], $value[1], $value[2]);
        }
        return $query->get();
    }
    public function searchAttribute($keyword, $attrType){
        $query = $this->model->whereHas('attribute_types', function($query) use ($attrType){
            $query->where('attribute_type_id', $attrType);
        })->whereHas('attribute_language', function($query) use ($keyword){
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })->get();
        // dd($query->toSql()); //Bỏ get ở dòng trên để sử dụng
        return $query;
    }
    public function getAttribute($id = '', $languageId){
        $column = [
            'id',
            'image',
            'publish',
            'follow',
            'order',
            'tb2.name',
            'tb2.description',
            'tb2.content',
            'tb2.meta_title',
            'tb2.meta_keyword',
            'tb2.meta_description',
            'tb2.canonical',
        ];
        $join = ['attribute_language as tb2', 'attributes.id', '=', 'tb2.attribute_id'];
        $query = $this->model->select($column)
        ->where('tb2.language_id', $languageId)
        ->join($join[0], $join[1], $join[2], $join[3]);
        if(!empty($id)){
            return $query->find($id);
        }
        return $query->get();
    }
}