<?php
namespace App\Repositories;

use App\Models\Language;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\LanguageRepositoryInterface;

class LanguageRepository extends BaseRepository implements LanguageRepositoryInterface
{
    public function __construct(Language $language)
    {
        $this->model = $language;
    }
}
