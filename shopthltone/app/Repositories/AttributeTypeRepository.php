<?php
namespace App\Repositories;

use App\Models\AttributeType;
use App\Repositories\Interfaces\AttributeTypeRepositoryInterface;
use App\Repositories\BaseRepository;

class AttributeTypeRepository extends BaseRepository implements AttributeTypeRepositoryInterface
{
    public function __construct(AttributeType $attributeType){
        $this->model = $attributeType;
    }
    public function getAttributeType($id = '', $languageId){
        $column = [
            'id',
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
        $join = ['attribute_type_language as tb2', 'attribute_types.id', '=', 'tb2.attribute_type_id'];
        $query = $this->model->select($column)
        ->where('tb2.language_id', $languageId)
        ->join($join[0], $join[1], $join[2], $join[3]);
        if(!empty($id)){
          return $query->find($id);
        }
        return $query->get();
    }
    public function loadAttributeType($select = [], array $condition = [], $whereIn = [], array $join = []){
        if (count($select) == 0) {
            $select = [
                'id',
                'tb2.name',
            ];
        }
        if (count($join) == 0) {
            $join = [['attribute_type_language as tb2', 'attribute_types.id', '=', 'tb2.attribute_type_id']];
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
}