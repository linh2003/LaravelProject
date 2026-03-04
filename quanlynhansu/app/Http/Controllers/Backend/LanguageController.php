<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Language\LanguageStoreRequest;
use App\Http\Requests\Module\Vocabulary\TranslateRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\LanguageServiceInterface as LanguageService;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use Illuminate\Support\Facades\Cache;

// use Illuminate\Support\Facades\App;

class LanguageController extends BackendController
{
    protected $languageService;
    protected $languageRepository;
    protected $asset;
    public function __construct(LanguageService $languageService, LanguageRepository $languageRepository){
        /** @var App\Services\Interfaces\LanuguageServiceInterface */
        $this->languageService = $languageService;
        /** @var App\Repositories\Interfaces\LanuguageRepositoryInterface */
        $this->languageRepository = $languageRepository;
    }
    public function storeTranslate($id, $languageId, $model, TranslateRequest $req){
        $backLink = strtolower(trim($model)).'.view';
        if ($this->languageService->storeTranslate($id, $languageId, $model, $req)) {
            return redirect()->route($backLink)->with('success', 'Translate data success');
        }
        return redirect()->route($backLink)->with('error', 'Translate data fail. Please try again!');
    }
    public function translate($id, $languageId, $model){
        $langCodeCurrent = session('app_locale');
        
        $langFrom = $this->languageRepository->findByCondition(
            ['id', 'name', 'image'], 
            [
                'where' => [['canonical', '=', $langCodeCurrent]]
            ]
        );
        $langTo = $this->languageRepository->findById($languageId);
        $repoModel = ucfirst(trim($model));
        $repository = 'App\Repositories\\'.$repoModel.'Repository';
        $data = [];
        if (class_exists($repository)) {
            $repositoryInstance = app($repository);
            $method = 'get'.$repoModel.'ById';
            $data = $repositoryInstance->{$method}($id, $langFrom->first()->id);
            $translate = $repositoryInstance->{$method}($id, $languageId);
        }
        $template = 'main.module.'.trim(strtolower($model)).'.component.translate';
        return view('main.layout', [
            'template' => $template,
            'languageTo' => $langTo,
            'languageFrom' => $langFrom,
            'data' => $data,
            'translate' => $translate,
        ]);
    }

    public function switchLanguage($id){
        $lang = $this->languageRepository->findById($id,['canonical']);
        if($this->languageService->switchLanguage($id)){
            Cache::forget('default_locale');
            session(['app_locale' => $lang->canonical]);
            return back();
        }
    }

    public function store(LanguageStoreRequest $request){
        if($language = $this->languageService->create($request)){
            return redirect()->route('admin.language')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('admin.language')->with('error','Thêm mới bản ghi thất bại. Vui lòng thử lại!');
    }
    
    public function create(){
        $template = 'main.language.store';
        $config = $this->config();
        $config['script'][] = $this->asset.'/plugins/ckfinder_2/ckfinder.js';
        $config['script'][] = $this->asset.'/js/libraries/finder.js';
            
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config
            ]
        );
    }

    public function index(Request $request){
        $template = 'main.language.index';
        $languages = $this->languageService->getLanguages($request);
        // dd($languages);
        $config = [
            'css' => [],
            'script' => [],
        ];
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config,
                'languages' => $languages,
            ]
        );
    }

    private function config(){
        return [
            'css' => [
                $this->asset.'/css/plugins/switchery/switchery.min.css'
            ],
            'script' => [
                $this->asset.'/js/plugins/switchery/switchery.min.js',
                $this->asset.'/js/setupSwitchery.js',
                $this->asset.'/js/checkboxes.js',
                $this->asset.'/js/switchStatus.js'
            ]
        ];
    }
}
