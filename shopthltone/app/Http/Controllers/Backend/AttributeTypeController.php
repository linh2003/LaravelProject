<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeTypeStoreRequest;
use App\Http\Requests\AttributeTypeUpdateRequest;
use App\Services\Interfaces\AttributeTypeServiceInterface as AttributeTypeService;
use App\Repositories\Interfaces\AttributeTypeRepositoryInterface as AttributeTypeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeTypeController extends Controller
{
    protected $attributeTypeService;
    protected $attributeTypeRepository;
    protected $userRepository;
    protected $asset;

    public function __construct(AttributeTypeService $attributeTypeService, AttributeTypeRepository $attributeTypeRepository){
        $this->attributeTypeService = $attributeTypeService;
        $this->attributeTypeRepository = $attributeTypeRepository;
        $this->asset = asset('backend');
    }
    public function destroy($id, Request $delReq){
        // dd($id);
        if ($this->attributeTypeService->destroy($id)) {
            return redirect()->route('product.attype')->with('success','Xóa dữ liệu thành công');
        }
        return redirect()->route('product.attype')->with('error','Xóa dữ liệu thất bại. Hãy thử lại!');
    }

    public function update($id,AttributeTypeUpdateRequest $req)
    {
        if ($this->attributeTypeService->update($id,$req)) {
            return redirect()->route('product.attype')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('product.attype')->with('error','Cập nhật bản ghi thất bại');
    }

    public function edit($id)
    {
        $language = $this->currentLanguage();
        $atType = $this->attributeTypeRepository->getAttributeTypeById($id,$language);
        // dd($postCat);
        $config = $this->config();
        // $config['js'][] = $this->asset.'/js/customodal.js';
        $config['heading'] = __('attribute_type');
        $config['method'] = 'update';
        $album = json_decode($atType->album);
        $template = 'backend.product.attribute_type.store';
        return view(
            'backend.layout',
            [
                'template'       => $template,
                'css'            => $config['css'],
                'scripts'        => $config['js'],
                'heading'        => $config['heading'],
                'method'         => $config['method'],
                'album'          => $album,
                'attributeType'  => $atType,
            ]
        );
    }

    public function store(AttributeTypeStoreRequest $req){
        if ($this->attributeTypeService->create($req)) {
            return redirect()->route('product.attype')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('product.attype')->with('error','Thêm mới bản ghi thất bại');
    }

    public function create(){
        $config = $this->config();
        $config['heading'] = __('attribute_type');
        $config['method'] = 'create';
        // dd($treeCat);
        $template = 'backend.product.attribute_type.store';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'css'       => $config['css'],
                'scripts'   => $config['js'],
                'heading'   => $config['heading'],
                'method'    => $config['method'],
            ]
        );
    }

    public function index(Request $request)
    {
        // $this->authorize('modules','admin.attributeType');
        $config = [];
        $config['css'][] = $this->asset.'/css/plugins/switchery/switchery.css';
        $config['js'][] = $this->asset.'/js/plugins/switchery/switchery.js';
        $config['js'][] = $this->asset.'/js/customCheckboxStatus.js';
        $config['js'][] = $this->asset.'/js/customSwitchery.js';
        $atTypes = $this->attributeTypeService->getAttributeTypes($request);
        $counter = $this->attributeTypeService->getAttributeTypes($request,true);
        $template = 'backend.product.attribute_type.index';
        return view(
            'backend.layout',
            [
                'template' => $template,
                'counter' => $counter,
                'atTypes' => $atTypes,
                'css' => $config['css'],
                'scripts' => $config['js'],
            ]
        );
    }
    private function currentLanguage(){
        $lang = DB::table('languages')->where('active','=',1)->value('id');
        return $lang;
    }
    private function config(){
        return [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
                $this->asset.'/css/plugins/jQueryUI/jquery-ui.css',
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
