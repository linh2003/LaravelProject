<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostServiceInterface as PostService;
use App\Services\Interfaces\PostCatServiceInterface as PostCatService;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Classes\Nestedsetbie;

class PostController extends Controller
{
    protected $postService;
    protected $postCatService;
    protected $postRepository;
    protected $userRepository;
    protected $language;
    protected $nestedset;
    protected $asset;
    public function __construct(PostService $postService, 
        PostCatService $postCatService, PostRepository $postRepository, UserRepository $userRepository)
    {
        $this->postService = $postService;
        $this->postCatService = $postCatService;
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
        $this->language = $this->currentLanguage();
        $this->asset = asset('backend');
        $this->nestedset = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' => $this->language
        ]);
    }

    public function destroy($id, Request $delReq){
        // dd('delete PostCatalogue');
        if ($this->postService->destroy($id)) {
            return redirect()->route('admin.post')->with('success','Xóa dữ liệu thành công');
        }
        return redirect()->route('admin.post')->with('error','Xóa dữ liệu thất bại. Hãy thử lại!');
    }

    public function update($id,PostUpdateRequest $req)
    {
        if ($this->postService->update($id,$req)) {
            return redirect()->route('admin.post')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('admin.post')->with('error','Cập nhật bản ghi thất bại');
    }
    public function edit($id){
        $posts = $this->postRepository->getPostById($id,$this->language);
        // dd($posts['post_catalogues']);
        $config = $this->config();
        $config['heading'] = config('apps.post');
        $config['method'] = 'update';
        $dropdown = $this->nestedset->Dropdown();
        $album = json_decode($posts->album);
        $template = 'backend.post.store';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'css'       => $config['css'],
                'scripts'   => $config['js'],
                'heading'   => $config['heading'],
                'method'    => $config['method'],
                'posts'     => $posts,
                'dropdown'  => $dropdown,
                'album'     => $album,
            ]
        );
    }
    public function store(PostStoreRequest $postRequest){
        if ($this->postService->create($postRequest)) {
            return redirect()->route('admin.post')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('admin.post')->with('error','Thêm mới bản ghi thất bại');
    }
    public function create(){
        $config = $this->config();
        $config['heading'] = config('apps.post');
        $config['method'] = 'create';
        $dropdown = $this->nestedset->Dropdown();
        $template = 'backend.post.store';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'css'       => $config['css'],
                'scripts'   => $config['js'],
                'heading'   => $config['heading'],
                'method'    => $config['method'],
                'dropdown'  => $dropdown,
            ]
        );
    }
    public function index(Request $request)
    {
        echo '<div style="color:#fff;font-size:30px">PostController:'.\App::getLocale().'</div>';
        $config = $this->config();
        $config['css'][] = $this->asset.'/css/plugins/switchery/switchery.css';
        $config['js'][] = $this->asset.'/js/plugins/switchery/switchery.js';
        $config['js'][] = $this->asset.'/js/customCheckboxStatus.js';
        $config['js'][] = $this->asset.'/js/customSwitchery.js';
        $template = 'backend.post.index';
        $posts = $this->postService->getPostsPagination($request);
        $dropdown = $this->nestedset->Dropdown();
        $counter = $this->postService->getPostsPagination($request,false);
        // $counter = 0;
        $config['heading'] = config('apps.post.index');
        return view('backend.layout',[
            'template'  => $template,
            'css'       => $config['css'],
            'scripts'   => $config['js'],
            'heading'   => $config['heading'],
            'dropdown'  => $dropdown,
            'data'      => $posts,
            'counter'   => $counter,
        ]);
    }
    private function config()
    {
         return [
            'css' => [
                $this->asset.'/css/plugins/jasny/jasny-bootstrap.min.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                $this->asset.'/js/customSelect2.js',
                $this->asset.'/plugins/ckfinder_2/ckfinder.js',
                $this->asset.'/plugins/ckeditor/ckeditor.js',
                $this->asset.'/js/finder.js',
                $this->asset.'/js/seo.js',
                $this->asset.'/js/customSortAble.js',
            ]
        ];
    }
}
