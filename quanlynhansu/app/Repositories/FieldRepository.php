<?php
namespace App\Repositories;

use App\Models\Field;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\FieldRepositoryInterface;

class FieldRepository extends BaseRepository implements FieldRepositoryInterface
{
    public function __construct(Field $Field)
    {
        $this->model = $Field;
    }
    public function getFieldByCondition($condition = [], $select = [], $orderBy = ['id', 'ASC'], $first = false){
        if (count($select) == 0) {
            $select = [
                'id',
                'field_code',
                'tb1.field_name as name',
                'vocabulary_id as vocId'
            ];
        }
        $query = $this->model->select($select)
        ->join('field_language as tb1', 'fields.id', '=', 'tb1.field_id');
        foreach ($condition as $it) {
            $query->where($it[0], $it[1], $it[2]);
        }
		$query->orderBy($orderBy[0], $orderBy[1]);
		if(!$first){
			return $query->get();
		}
        return $query->first();
    }
    public function getFieldById($id, $languageId, $select = ['*']){
        $query = $this->model->select($select);
        $query->join('field_language as tb1', 'fields.id', '=', 'tb1.field_id');
        $query->where(function($query) use ($id, $languageId){
            $query->where('fields.id', '=', $id)
            ->where('tb1.language_id', '=', $languageId);
        });
        return $query->first();
    }
}
