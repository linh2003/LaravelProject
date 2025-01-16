<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeStoreRequest;
use App\Http\Requests\AttributeUpdateRequest;
use App\Services\Interfaces\AttributeServiceInterface as AttributeService;
use App\Repositories\Interfaces\AttributeRepositoryInterface as AttributeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Classes\Nestedsetbie;

class AttributeController extends Controller
{
    protected $attributeService;
    protected $attributeRepository;
    protected $userRepository;
    protected $nestedset;
    protected $asset;

    public function __construct(AttributeService $attributeService, AttributeRepository $attributeRepository){
        $this->attributeService = $attributeService;
        $this->attributeRepository = $attributeRepository;
        $this->asset = asset('backend');
        $this->nestedset = new Nestedsetbie([
            'table' => 'attribute_types',
            'suffix' => 'type', //do ko đặt tên col chứa catalogue
            'foreignkey' => 'attribute_type_id',
            'language_id' => $this->currentLanguage()
        ]);
    }

    public function destroy($id, Request $delReq){
        // dd($id);
        if ($this->attributeService->destroy($id)) {
            return redirect()->route('product.attribute')->with('success',__('attribute.message.delete.success'));
        }
        return redirect()->route('product.attribute')->with('error',__('attribute.message.delete.error'));
    }

    public function update($id,AttributeUpdateRequest $req)
    {
        if ($this->attributeService->update($id,$req)) {
            return redirect()->route('product.attribute')->with('success',__('attribute.message.update.success'));
        }
        return redirect()->route('product.attribute')->with('error',__('attribute.message.update.error'));
    }

    public function edit($id)
    {
        $language = $this->currentLanguage();
        $attribute = $this->attributeRepository->getAttributeById($id,$language);
        // dd($postCat);
        $config = $this->config();
        $dropdown = $this->nestedset->Dropdown();
        $config['heading'] = __('attribute');
        $config['method'] = 'update';
        $album = json_decode($attribute->album);
        $template = 'backend.product.attribute.store';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'css'       => $config['css'],
                'scripts'   => $config['js'],
                'heading'   => $config['heading'],
                'method'    => $config['method'],
                'album'     => $album,
                'data'      => $attribute,
                'dropdown'  => $dropdown,
            ]
        );
    }

    public function store(AttributeStoreRequest $req){
        if ($this->attributeService->create($req)) {
            return redirect()->route('product.attribute')->with('success',__('attribute.message.create.success'));
        }
        return redirect()->route('product.attribute')->with('error',__('attribute.message.create.error'));
    }

    public function create(){
        $config = $this->config();
        $config['heading'] = __('attribute');
        $config['method'] = 'create';
        $dropdown = $this->nestedset->Dropdown();
        // dd($dropdown);
        $template = 'backend.product.attribute.store';
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
        // $this->authorize('modules','admin.attribute');
        $config = [];
        $config['css'][] = $this->asset.'/css/plugins/switchery/switchery.css';
        $config['js'][] = $this->asset.'/js/plugins/switchery/switchery.js';
        $config['js'][] = $this->asset.'/js/customCheckboxStatus.js';
        $config['js'][] = $this->asset.'/js/customSwitchery.js';
        $attribute = $this->attributeService->getAttributes($request);
        $counter = $this->attributeService->getAttributes($request,true);
        $template = 'backend.product.attribute.index';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'counter'   => $counter,
                'data'      => $attribute,
                'css'       => $config['css'],
                'scripts'   => $config['js'],
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
