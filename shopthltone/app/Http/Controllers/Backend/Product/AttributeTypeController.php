<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeTypeDeleteRequest;
use App\Http\Requests\AttributeTypeStoreRequest;
use App\Http\Requests\AttributeTypeUpdateRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\AttributeTypeServiceInterface as AttributeTypeService;
use App\Repositories\Interfaces\AttributeTypeRepositoryInterface as AttributeTypeRepository;

class AttributeTypeController extends BackendController
{
    protected $attributeTypeRepository;
    protected $attributeTypeService;
    public function __construct(AttributeTypeRepository $attributeTypeRepository, AttributeTypeService $attributeTypeService){
        parent::__construct();
        $this->attributeTypeRepository = $attributeTypeRepository;
        $this->attributeTypeService = $attributeTypeService;
    }
    public function remove($id, AttributeTypeDeleteRequest $req){
        // dd($id);
        if($this->attributeTypeService->remove($id)){
            return redirect()->route('product.attributetype')->with('success', __('attribute_type.message.delete.success'));
        }
        return redirect()->route('product.attributetype')->with('error', __('attribute_type.message.delete.error'));
    }
    public function update($id, AttributeTypeUpdateRequest $request){
        if ($this->attributeTypeService->update($id, $request)) {
            return redirect()->route('product.attributetype')->with('success', __('attribute_type.message.update.success'));
        }
        return redirect()->route('product.attributetype')->with('error', __('attribute_type.message.update.error'));
    }
    public function edit($id){
        $template = 'backend.product.attribute_type.store';
        $heading = __('attribute_type');
        $general = __('general');
        $method = 'update';
        $config = $this->config();
        $attributeType = $this->attributeTypeService->getAttributeType($id);
        return view(
            'backend.layout',
            [
                'template'      => $template,
                'heading'       => $heading,
                'method'        => $method,
                'general'       => $general,
                'config'        => $config,
                'attributeType' => $attributeType,
            ]
        );
    }
    public function store(AttributeTypeStoreRequest $request){
        if ($this->attributeTypeService->create($request)) {
            return redirect()->route('product.attributetype')->with('success', __('attribute_type.message.create.success'));
        }
        return redirect()->route('product.attributetype')->with('error', __('attribute_type.message.create.error'));
    }
    public function create(){
        $template = 'backend.product.attribute_type.store';
        $heading = __('attribute_type');
        $general = __('general');
        $method = 'create';
        $config = $this->config();
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'heading'   => $heading,
                'method'    => $method,
                'general'   => $general,
                'config'    => $config,
            ]
        );
    }
    public function index(Request $request){
        $template = 'backend.product.attribute_type.index';
        $attributeTypes = $this->attributeTypeService->getData($request, false);
        $counter = $this->attributeTypeService->getData($request, true);
        $heading = __('attribute_type');
        $general = __('general');
        $config = $this->config();
        $config['css'][] = $this->asset.'/css/plugins/switchery/switchery.css';
        $config['script'][] = $this->asset.'/js/plugins/switchery/switchery.js';
        $config['script'][] = $this->asset.'/js/customSwitchery.js';
        $config['script'][] = $this->asset.'/js/checkboxList.js';
        $config['config'] = config('apps.general');
        return view(
            'backend.layout',
            [
                'template'          => $template,
                'heading'           => $heading,
                'general'           => $general,
                'config'            => $config,
                'attributeTypes'    => $attributeTypes,
                'counter'           => $counter,
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
                $this->asset.'/plugins/ckeditor/ckeditor.js',
                $this->asset.'/js/seo.js',
            ]
        ];
    }
}
