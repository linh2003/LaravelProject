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
    public function getAttributeTypeById(int $id=0, int $language_id=0)
    {
        return $this->model->select(
            [
                'attribute_types.id',
                'attribute_types.parentid',
                'attribute_types.icon',
                'attribute_types.image',
                'attribute_types.album',
                'attribute_types.publish',
                'tb2.name',
                'tb2.description',
                'tb2.canonical',
                'tb2.content',
                'tb2.meta_title',
                'tb2.meta_keyword',
                'tb2.meta_desc',
            ]
        )->join('attribute_type_languages as tb2','tb2.attribute_type_id','=','attribute_types.id')
        ->where('tb2.language_id','=',$language_id)
        ->findOrFail($id);
    }
    
}