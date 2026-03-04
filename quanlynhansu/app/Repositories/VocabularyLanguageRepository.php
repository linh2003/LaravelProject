<?php
namespace App\Repositories;

use App\Models\VocabularyLanguage;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\VocabularyLanguageRepositoryInterface;

class VocabularyLanguageRepository extends BaseRepository implements VocabularyLanguageRepositoryInterface
{
    public function __construct(VocabularyLanguage $vocabularyLanguage)
    {
        $this->model = $vocabularyLanguage;
    }
}
