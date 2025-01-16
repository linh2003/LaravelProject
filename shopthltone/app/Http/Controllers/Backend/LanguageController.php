<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\Interfaces\LanguageServiceInterface as LanguageService;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use App\Http\Requests\LanguageRequest;
use App\Http\Requests\LanguageUpdateRequest;

class LanguageController extends Controller
{
    protected $languageService;
    protected $languageRepository;
    protected $asset;
    public function __construct(LanguageService $languageService, LanguageRepository $languageRepository){
        $this->languageService = $languageService;
        $this->languageRepository = $languageRepository;
        $this->asset = asset('backend');
    }

    public function switchBackendLanguage($id){
        $lang = $this->languageRepository->findByID($id);
        // dd($lang->canonical);
        if($this->languageService->switchLanguage($id)){
            // dd($lang->canonical);
            session(['app_locale'=>$lang->canonical]);
            \App::setLocale($lang->canonical);
        }
        return back();
    }
    public function destroy($id){
        if ($this->languageService->destroy($id)) {
            return redirect()->route('admin.language')->with('success','Xóa dữ liệu thành công');
        }
        return redirect()->route('admin.language')->with('error','Xóa dữ liệu thất bại. Hãy thử lại!');
    }
    public function delete($id){
        $language = $this->languageRepository->findByID($id);
        $config['heading'] = config('apps.language');
        $template = 'backend.language.delete';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'heading'   => $config['heading'],
                'language'  => $language,
            ]
        );
    }
    public function update($id,LanguageUpdateRequest $req){
        if ($this->languageService->update($id,$req)) {
            return redirect()->route('admin.language')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('admin.language')->with('error','Cập nhật bản ghi thất bại');
    }
    public function edit($id){
        $language = $this->languageRepository->findByID($id);
        $config = $this->config();
        $config['heading'] = config('apps.language');
        $config['method'] = 'update';
        $users = $this->languageService->getAllUser();
        $template = 'backend.language.store';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'css'       => $config['css'],
                'scripts'   => $config['js'],
                'heading'   => $config['heading'],
                'method'    => $config['method'],
                'language'  => $language,
                'users'     => $users,
            ]
        );
    }
    public function store(LanguageRequest $languageRequest){
        if ($this->languageService->create($languageRequest)) {
            return redirect()->route('admin.language')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('admin.language')->with('error','Thêm mới bản ghi thất bại');
    }
    public function create(){
        $config = $this->config();
        $config['heading'] = config('apps.language');
        $config['method'] = 'create';
        $users = $this->languageService->getAllUser();
        $uidLogged = Auth::id();
        $template = 'backend.language.store';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'css'       => $config['css'],
                'scripts'   => $config['js'],
                'heading'   => $config['heading'],
                'method'    => $config['method'],
                'users'     => $users,
                'uidLogged' => $uidLogged,
            ]
        );
    }
    public function index(Request $request)
    {
        echo '<div style="color:#fff;font-size:30px">LanguageController:'.\App::getLocale().'</div>';
        $config = $this->config();
        $config['js'][] = $this->asset.'/js/customCheckboxStatus.js';
        $template = 'backend.language.index';
        $languages = $this->languageService->getLanguagePagination($request);
        // $languages = $this->languageRepository->getAll();
        $counter = $this->languageService->getLanguagePagination($request,false);
        $config['heading'] = config('apps.language.index');
        return view('backend.layout',[
            'template'  => $template,
            // 'css'       => $config['css'],
            'scripts'   => $config['js'],
            'heading'   => $config['heading'],
            'data'      => $languages,
            'counter'   => $counter,
        ]);
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
