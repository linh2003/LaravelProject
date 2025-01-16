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
    public function getAttributeById(int $id=0, int $language_id=0)
    {
        return $this->model->select(
            [
                'attributes.id',
                'attributes.attribute_type_id',
                'attributes.icon',
                'attributes.image',
                'attributes.album',
                'attributes.publish',
                'tb2.name',
                'tb2.description',
                'tb2.canonical',
                'tb2.content',
                'tb2.meta_title',
                'tb2.meta_keyword',
                'tb2.meta_desc',
            ]
        )->join('attribute_languages as tb2','tb2.attribute_id','=','attributes.id')
        ->where('tb2.language_id','=',$language_id)
        ->findOrFail($id);
    }
    public function searchAttributes(string $keyword='', array $option=[], int $languageId){
        return $this->model->whereHas('attribute_types',function($query) use ($option){
            $query->where('attribute_type_id',$option['attributeTypeId']);
        })->whereHas('attribute_languages', function($query) use ($keyword){
            $query->where('name','LIKE', '%'.$keyword.'%');
        })->get();
    }
    public function findAttributeByIdArrray($attributeArr, $languageId){
        return $this->model->select(['attributes.id', 'tb2.name'])
        ->join('attribute_languages as tb2', 'tb2.attribute_id', '=', 'attributes.id')
        ->whereIn('attributes.id', $attributeArr)
        ->where('tb2.language_id', '=', $languageId)->get();
    }
}