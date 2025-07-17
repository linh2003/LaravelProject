<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageStoreRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\LanguageServiceInterface as LanguageService;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use Illuminate\Support\Facades\Cache;

// use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    protected $languageService;
    protected $languageRepository;
    protected $asset;
    public function __construct(LanguageService $languageService, LanguageRepository $languageRepository){
        /** @var App\Services\Interfaces\LanuguageServiceInterface */
        $this->languageService = $languageService;
        /** @var App\Repositories\Interfaces\LanuguageRepositoryInterface */
        $this->languageRepository = $languageRepository;
        $this->asset = asset('backend');
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
                $this->asset.'/css/libraries/switchery.min.css'
            ],
            'script' => [
                $this->asset.'/js/libraries/switchery.min.js',
                $this->asset.'/js/libraries/swithces.js',
                $this->asset.'/js/customSwitchery.js',
                $this->asset.'/js/libraries/jquery.slimscroll.js',
                $this->asset.'/js/libraries/waves.min.js',
                $this->asset.'/js/libraries/popper.min.js',
            ]
        ];
    }
}
