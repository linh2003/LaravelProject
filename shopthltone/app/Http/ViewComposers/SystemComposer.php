<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Interfaces\SystemRepositoryInterface as SystemRepository;
use App\Repositories\Interfaces\PromotionRepositoryInterface as PromotionRepository;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use Illuminate\Support\Facades\DB;

class SystemComposer
{
    protected $systemRepository;
    protected $languageRepository;
    public function __construct(SystemRepository $systemRepository, LanguageRepository $languageRepository){
        $this->systemRepository = $systemRepository;
        $this->languageRepository = $languageRepository;
    }
    public function compose(View $view){
        $language = $this->languageRepository->findByCondition(
            ["id"],
            [['active', '=', 1]]
        );
        // dd($language->first()->id);
        $system = $this->systemRepository->findByCondition(
            ['keyword', 'content'],
            [['language_id', '=', $language->first()->id]]
        );
        $systems = convertArray($system, 'keyword', 'content');
        // dd($systems);
        $view->with('system', $systems);
    }
}