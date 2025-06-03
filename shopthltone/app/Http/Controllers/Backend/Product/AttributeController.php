<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeDeleteRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\AttributeServiceInterface as AttributeService;
use App\Repositories\Interfaces\AttributeRepositoryInterface as AttributeRepository;
use App\Services\Interfaces\AttributeTypeServiceInterface as AttributeTypeService;
use App\Http\Requests\AttributeStoreRequest;
use App\Http\Requests\AttributeUpdateRequest;

class AttributeController extends BackendController
{
    protected $attributeRepository;
    protected $attributeTypeService;
    protected $attributeService;
    public function __construct(AttributeRepository $attributeRepository, AttributeService $attributeService, AttributeTypeService $attributeTypeService){
        parent::__construct();
        $this->attributeRepository = $attributeRepository;
        $this->attributeTypeService = $attributeTypeService;
        $this->attributeService = $attributeService;
    }
    public function deleteAll(Request $request){
        $ids = $request->input;
        if($this->attributeService->deleteAll($ids)){
            return redirect()->route('product.attribute')->with('success', __('product.message.delete.success'));
        }
        return redirect()->route('product.attribute')->with('error', __('product.message.delete.error'));
    }
    public function remove($id, AttributeDeleteRequest $req){
        // dd($id);
        if($this->attributeService->remove($id)){
            return redirect()->route('product.attribute')->with('success', __('attribute.message.delete.success'));
        }
        return redirect()->route('product.attribute')->with('error', __('attribute.message.delete.error'));
    }
    public function update($id, AttributeUpdateRequest $request){
        if ($this->attributeService->update($id, $request)) {
            return redirect()->route('product.attribute')->with('success', __('attribute.message.update.success'));
        }
        return redirect()->route('product.attribute')->with('error', __('attribute.message.update.error'));
    }
    public function edit($id){
        $template = 'backend.product.attribute.store';
        $heading = __('attribute');
        $general = __('general');
        $method = 'update';
        $config = $this->config();
        $attribute = $this->attributeService->getAttribute($id);
        $attributeTypes = $this->attributeTypeService->getAttributeType();
        // dd($attribute);
        return view(
            'backend.layout',
            [
                'template'          => $template,
                'heading'           => $heading,
                'method'            => $method,
                'general'           => $general,
                'config'            => $config,
                'attribute'         => $attribute,
                'attributeTypes'    => $attributeTypes,
            ]
        );
    }
    public function store(AttributeStoreRequest $request){
        if ($this->attributeService->create($request)) {
            return redirect()->route('product.attribute')->with('success', __('attribute.message.create.success'));
        }
        return redirect()->route('product.attribute')->with('error', __('attribute.message.create.error'));
    }
    public function create(){
        $template = 'backend.product.attribute.store';
        $heading = __('attribute');
        $general = __('general');
        $method = 'create';
        $config = $this->config();
        $attributeTypes = $this->attributeTypeService->getAttributeType();
        // dd($attributeTypes);
        return view(
            'backend.layout',
            [
                'template'          => $template,
                'heading'           => $heading,
                'method'            => $method,
                'general'           => $general,
                'config'            => $config,
                'attributeTypes'    => $attributeTypes,
            ]
        );
    }
    public function index(Request $request){
        $template = 'backend.product.attribute.index';
        $attributes = $this->attributeService->getData($request, false);
        $counter = $this->attributeService->getData($request, true);
        $heading = __('attribute');
        $general = __('general');
        $config = $this->config();
        $config['css'][] = $this->asset.'/css/plugins/switchery/switchery.css';
        $config['script'][] = $this->asset.'/js/plugins/switchery/switchery.js';
        $config['script'][] = $this->asset.'/js/customSwitchery.js';
        $config['script'][] = $this->asset.'/js/checkboxList.js';
        $config['script'][] = $this->asset.'/js/setupDeleteMultiple.js';
        $config['config'] = config('apps.general');
        return view(
            'backend.layout',
            [
                'template'          => $template,
                'heading'           => $heading,
                'general'           => $general,
                'config'            => $config,
                'attributes'    => $attributes,
                'counter'           => $counter,
            ]
        );
    }
    private function config(){
        return [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ],
            'script' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                $this->asset.'/js/customSelect2.js',
                $this->asset.'/js/checkboxList.js',
                $this->asset.'/plugins/ckfinder_2/ckfinder.js',
                $this->asset.'/js/finder.js',
                $this->asset.'/plugins/ckeditor/ckeditor.js',
                $this->asset.'/js/seo.js',
            ]
        ];
    }
}
