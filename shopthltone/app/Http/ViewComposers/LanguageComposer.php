<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;

class LanguageComposer
{
    protected $languageRepository;
    public function __construct(LanguageRepository $languageRepository){
        $this->languageRepository = $languageRepository;
    }
    public function compose(View $view){
        $languages = $this->languageRepository->all();
        $language_active = $this->languageRepository->findByCondition(['id'], [['active', '=', 1]]);
        $language = [
            'all' => $languages,
            'active' => $language_active->first()->id,
        ];
        $view->with('language', $language);
    }
}