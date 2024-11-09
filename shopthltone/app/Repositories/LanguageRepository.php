<?php
namespace App\Repositories;

use App\Models\Language;
use App\Repositories\Interfaces\LanguageRepositoryInterface;
use App\Repositories\BaseRepository;

class LanguageRepository extends BaseRepository implements LanguageRepositoryInterface
{
    public function __construct(Language $languages){
        $this->model = $languages;
    }

    public function findCurrentLanguage(){
        return $this->model->select('canonical')->where('current','=',1)->first();
    }
}