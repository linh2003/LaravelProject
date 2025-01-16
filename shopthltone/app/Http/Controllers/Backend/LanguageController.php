<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LanguageRequest;
use App\Services\Interfaces\LanguageServiceInterface as LanguageService;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    protected $languageService;
    protected $languageRepository;
    protected $userRepository;
    protected $asset;
    public function __construct(LanguageService $languageService, LanguageRepository $languageRepository, UserRepository $userRepository){
        $this->languageService = $languageService;
        $this->languageRepository = $languageRepository;
        $this->userRepository = $userRepository;
        $this->asset = asset('backend');
    }

    public function switchLanguage($id){
        $lang = $this->languageRepository->findByID($id,['canonical']);
        if($this->languageService->switchLanguage($id)){
            session(['app_locale'=>$lang->canonical]);
            \App::setLocale($lang->canonical);
            return back();
        }
    }
    public function store(LanguageRequest $languageRequest){
        if ($this->languageService->create($languageRequest)) {
            return redirect()->route('admin.language')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('admin.language')->with('error','Thêm mới bản ghi thất bại');
    }
    public function create(){
        $config = $this->config();
        // $config['heading'] = config('apps.language');
        $config['method'] = 'create';
        $users = $this->userRepository->getAll();
        $uidLogged = Auth::id();
        $template = 'backend.language.store';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'css'       => $config['css'],
                'scripts'   => $config['js'],
                // 'heading'   => $config['heading'],
                'method'    => $config['method'],
                'users'     => $users,
                'uidLogged' => $uidLogged,
            ]
        );
    }
    public function index(Request $request)
    {

        // $user = $this->userRepository->findById(1, ['*'], ['roles']);

        // echo 123;die();
        $this->authorize('modules','admin.user.create');
        $languages = $this->languageService->getLanguages($request);
        $counter = $this->languageService->getLanguages($request,false);
        $template = 'backend.language.index';
        return view(
            'backend.layout',
            [
                'template' => $template,
                'counter' => $counter,
                'data' => $languages,
            ]
        );
    }
    private function config(){
        return [
            'css' => [
                $this->asset.'/css/plugins/jasny/jasny-bootstrap.min.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                $this->asset.'/plugins/ckfinder_2/ckfinder.js',
                $this->asset.'/js/customSelect2.js',
                $this->asset.'/js/finder.js'
            ]
        ];
    }
}
