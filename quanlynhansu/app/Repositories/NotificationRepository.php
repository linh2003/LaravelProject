<?php
namespace App\Repositories;

use App\Models\Vocabulary;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\VocabularyRepositoryInterface;

class VocabularyRepository extends BaseRepository implements VocabularyRepositoryInterface
{
    public function __construct(Vocabulary $vocabulary)
    {
        $this->model = $vocabulary;
    }
    public function getVocabularies($condition = [], $select = [], $orderBy = ['id', 'DESC']){
        if (count($select) == 0) {
            $select = [
                'id',
                'tb1.name as name'
            ];
        }
        $query = $this->model->select($select)
        ->join('vocabulary_language as tb1', 'vocabularies.id', '=', 'tb1.vocabulary_id');
        foreach ($condition as $it) {
            $query->where($it[0], $it[1], $it[2]);
        }
        return $query->get();
    }
    public function getVocabularyById($id, $languageId, $select = ['*']){
        $query = $this->model->select($select);
        $query->join('vocabulary_language as tb1', 'vocabularies.id', '=', 'tb1.vocabulary_id');
        $query->where(function($query) use ($id, $languageId){
            $query->where('vocabularies.id', '=', $id)
            ->where('tb1.language_id', '=', $languageId);
        });
        return $query->first();
    }
}
