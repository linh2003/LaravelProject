<?php
namespace App\Repositories;

use App\Models\Term;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\TermRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TermRepository extends BaseRepository implements TermRepositoryInterface
{
    public function __construct(Term $term)
    {
        $this->model = $term;
    }
    public function updateOrder($order){
        $cases = [];
        $ids = [];
        foreach ($order as $item) {
            $cases[] = "WHEN {$item['id']} THEN {$item['order']}";
            $ids[] = $item['id'];
        }
        $ids = implode(',', $ids);
        $cases = implode(' ', $cases);
        return DB::update("UPDATE terms SET `order` = CASE id {$cases} END WHERE id IN ({$ids})");
    }
    public function getTermByCondition($condition = '', $languageId, $orderBy = ['order', 'ASC'], $select = []){
        if (count($select) == 0) {
            $select = [
                'terms.id as id',
                'tb1.name as name',
            ];
        }
        $query = $this->model->select($select)
        ->join('term_language as tb1', 'terms.id', '=', 'tb1.term_id')
        ->where('tb1.language_id', '=', $languageId)
        ->where('terms.vocabulary_id', '=', $condition)
        ->orderBy($orderBy[0], $orderBy[1]);
        return $query->get();
    }
    public function getTermById($id, $languageId, $select = []){
        if (count($select) == 0) {
            $select = [
                'terms.id as id',
                'terms.publish as publish',
                'tb1.name as name',
                'tb1.code as code',
                'tb1.description as description',
                'tb2.id as vocid',
                'tb3.name as vocname',
            ];
        }
        $query = $this->model->select($select);
        $query->join('term_language as tb1', 'terms.id', '=', 'tb1.term_id');
        $query->join('vocabularies as tb2', 'terms.vocabulary_id', '=', 'tb2.id');
        $query->join('vocabulary_language as tb3', 'tb2.id', '=', 'tb3.vocabulary_id');
        $query->where(function($query) use ($id, $languageId){
            $query->where('terms.id', '=', $id)
            ->where('tb1.language_id', '=', $languageId)
            ->where('tb3.language_id', '=', $languageId);
        });
        return $query->first();
    }
}
