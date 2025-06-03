<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\LanguageStoreRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\LanguageServiceInterface as LanguageService;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use Illuminate\Support\Facades\Auth;

class LanguageController extends BackendController
{
    protected $languageService;
    protected $languageRepository;

    public function __construct(LanguageService $languageService, LanguageRepository $languageRepository){
        parent::__construct();
        $this->languageService = $languageService;
        $this->languageRepository = $languageRepository;
    }
    public function switchLanguage($id){
        $lang = $this->languageRepository->findById($id, ['canonical']);
        if($this->languageService->switchLanguage($id)){
            session(['app_locale' => $lang->canonical]);
            \App::setLocale($lang->canonical);
        }
        return back();
    }
    public function store(LanguageStoreRequest $request){
        if ($this->languageService->create($request)) {
            return redirect()->route('admin.language')->with('success', 'Thêm mới bản ghi thành công!');
        }
        return redirect()->route('admin.language')->with('error', 'Thêm mới bản ghi thất bại!');
    }
    public function create(){
        $template = 'backend.language.store';
        $method = 'create';
        $user = Auth::user();
        $config = $this->config();
        return view(
            'backend.layout', 
        [
                'template'  => $template,
                'method'    => $method,
                'user'      => $user,
                'config'    => $config,
            ]
        );
    }
    public function index(Request $request){
        $template = 'backend.language.index';
        $data = $this->languageService->getData($request);
        $counter = $this->languageService->getData($request, true);
        return view(
            'backend.layout',
            [
                'template' => $template,
                'data' => $data,
                'counter' => $counter,
            ]
        );
    }
    private function config(){
        return [
            'css' => [

            ],
            'script' => [
                $this->asset.'/plugins/ckfinder_2/ckfinder.js',
                $this->asset.'/js/finder.js',
            ]
        ];
    }
}
