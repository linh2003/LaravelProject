<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostCatServiceInterface as PostCatService;
use App\Repositories\Interfaces\PostCatRepositoryInterface as PostCatRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Http\Requests\PostCatRequest;
use App\Http\Requests\PostCatUpdateRequest;
use App\Http\Requests\DeletePostCatRequest;
use App\Classes\Nestedsetbie;

class PostCatalogueController extends Controller
{
    protected $postCatService;
    protected $postCatRepository;
    protected $nestedset;
    protected $language;
    protected $asset;
    public function __construct(PostCatService $postCatService, PostCatRepository $postCatRepository)
    {
        $this->postCatService = $postCatService;
        $this->postCatRepository = $postCatRepository;
        $this->language = $this->currentLanguage();
        $this->asset = asset('backend');
        $this->nestedset = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' => $this->language
        ]);
    }

    public function destroy($id, DeletePostCatRequest $delReq){
        // dd('delete PostCatalogue');
        if ($this->postCatService->destroy($id)) {
            return redirect()->route('admin.post.cat')->with('success','Xóa dữ liệu thành công');
        }
        return redirect()->route('admin.post.cat')->with('error','Xóa dữ liệu thất bại. Hãy thử lại!');
    }
    public function update($id,PostCatUpdateRequest $req)
    {
        if ($this->postCatService->update($id,$req)) {
            return redirect()->route('admin.post.cat')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('admin.post.cat')->with('error','Cập nhật bản ghi thất bại');
    }
    public function edit($id)
    {
        $postCat = $this->postCatRepository->getPostCatalogueById($id,$this->language);
        // dd($postCat);
        $config = $this->config();
        // $config['js'][] = $this->asset.'/js/customodal.js';
        $config['heading'] = config('apps.postcatalogues');
        $config['method'] = 'update';
        $dropdown = $this->nestedset->Dropdown();
        $pCat = $this->postCatService->getPostCatalogues();
        $treeCat = $this->handleTreeCat($pCat);
        $album = json_decode($postCat->album);
        $template = 'backend.post.catalogues.store';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'css'       => $config['css'],
                'scripts'   => $config['js'],
                'heading'   => $config['heading'],
                'method'    => $config['method'],
                'dropdown'  => $dropdown,
                'postCat'   => $postCat,
                'treeCat'   => $treeCat,
                'album'     => $album,
            ]
        );
    }
    public function store(PostCatRequest $postCatRequest){
        if ($this->postCatService->create($postCatRequest)) {
            return redirect()->route('admin.post.cat')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('admin.post.cat')->with('error','Thêm mới bản ghi thất bại');
    }
    public function create(){
        $config = $this->config();
        $config['heading'] = config('apps.postcatalogues');
        $config['method'] = 'create';
        $dropdown = $this->nestedset->Dropdown();
        $postCat = $this->postCatService->getPostCatalogues();
        $treeCat = $this->handleTreeCat($postCat);
        // dd($treeCat);
        $template = 'backend.post.catalogues.store';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'css'       => $config['css'],
                'scripts'   => $config['js'],
                'heading'   => $config['heading'],
                'method'    => $config['method'],
                'dropdown'  => $dropdown,
                'treeCat'   => $treeCat,
            ]
        );
    }
    // public function index(Request $request)
    // {
    //     $config = $this->config();
    //     $config['css'][] = $this->asset.'/css/plugins/switchery/switchery.css';
    //     $config['js'][] = $this->asset.'/js/plugins/switchery/switchery.js';
    //     $config['js'][] = $this->asset.'/js/customCheckboxStatus.js';
    //     $config['js'][] = $this->asset.'/js/customSwitchery.js';
    //     $template = 'backend.post.catalogues.index';
    //     $postcat = $this->postCatService->getPostCatPagination($request);
    //     $users = $this->postCatRepository->getAll();
    //     $counter = $this->postCatService->getPostCatPagination($request,false);
    //     $config['heading'] = config('apps.postcatalogues.index');
    //     return view('backend.layout',[
    //         'template'  => $template,
    //         'css'       => $config['css'],
    //         'scripts'   => $config['js'],
    //         'heading'   => $config['heading'],
    //         'data'      => $postcat,
    //         'counter'   => $counter,
    //     ]);
    // }
    private function config(){
        return [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
                $this->asset.'/css/plugins/jQueryUI/jquery-ui.css',
                $this->asset.'/plugins/jsTree/style.min.css',
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                $this->asset.'/js/inspinia.js',
                $this->asset.'/js/customSelect2.js',
                $this->asset.'/plugins/ckfinder_2/ckfinder.js',
                $this->asset.'/plugins/ckeditor/ckeditor.js',
                $this->asset.'/js/finder.js',
                $this->asset.'/js/seo.js',
                $this->asset.'/js/plugins/jsTree/jstree.min.js',
                $this->asset.'/js/customTree.js',
                $this->asset.'/js/customSortAble.js',
            ]
        ];
    }
    // private function currentLanguage()
    // {
    //     return 1;
    // }
    private function handleTreeCat($postCat=[])
    {
        $htmlTree = '';
        $level=0;
        foreach($postCat as $k => $pc){
            if($pc->level > $level){
                $htmlTree .= '<ul>';
            }elseif($pc->level < $level){
               $htmlTree .= str_repeat('</ul></li>', $level - $pc->level);
            }
            $htmlTree .= '<li class="jstree-open"><a href="'.route("post.cat.edit",["id"=>$pc->id]).'">'.$pc->name.'</a>';
            if(($pc->rgt-$pc->lft)==1){
                $htmlTree .= '</li>';
            }
            $level=$pc->level;
        }
        $htmlTree .= str_repeat('</ul></li>', $level-1);
        $htmlTree .= '</ul>';
        return $htmlTree;
    }
}
