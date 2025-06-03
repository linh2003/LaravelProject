<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\ProductServiceInterface as ProductService;
use App\Services\Interfaces\ProductCatalogueServiceInterface as ProductCatalogueService;
use App\Services\Interfaces\AttributeTypeServiceInterface as AttributeTypeService;

class ProductController extends BackendController
{
    protected $productService;
    protected $productCatalogueService;
    protected $attributeTypeService;
    public function __construct(ProductService $productService, ProductCatalogueService $productCatalogueService, AttributeTypeService $attributeTypeService)
    {
        parent::__construct();
        $this->productService = $productService;
        $this->productCatalogueService = $productCatalogueService;
        $this->attributeTypeService = $attributeTypeService;
    }
    public function deleteAll(Request $request){
        $ids = $request->input;
        if($this->productService->deleteAll($ids)){
            return redirect()->route('admin.product')->with('success', __('product.message.delete.success'));
        }
        return redirect()->route('admin.product')->with('error', __('product.message.delete.error'));
    }
    public function remove($id){
        // dd($id);
        if($this->productService->remove($id)){
            return redirect()->route('admin.product')->with('success', __('product.message.delete.success'));
        }
        return redirect()->route('admin.product')->with('error', __('product.message.delete.error'));
    }
    public function update($id, ProductUpdateRequest $request){
        if ($this->productService->update($id, $request)) {
            return redirect()->route('admin.product')->with('success',__('product.message.update.success'));
        }
        return redirect()->route('admin.product')->with('error',__('product.message.update.error'));
    }
    public function edit($id){
        $template = 'backend.product.product.store';
        $heading = __('product');
        $general = __('general');
        $config = $this->config();
        $method = 'update';
        $dropdown = $this->productCatalogueService->getDropdown(['text' => $heading['create']['field']['catalogues']['label']]);
        $attributeTypes = $this->attributeTypeService->getAttributeType();
        $product = $this->productService->getProduct($id);
        $album = $this->productService->getAlbum($id);
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'heading'   => $heading,
                'general'   => $general,
                'config'    => $config,
                'method'    => $method,
                'dropdown'  => $dropdown,
                'attributeTypes'  => $attributeTypes,
                'data'  => $product,
                'album'  => $album,
            ]
        );
    }
    public function store(ProductStoreRequest $request){
        if ($this->productService->create($request)) {
            return redirect()->route('admin.product')->with('success',__('product.message.create.success'));
        }
        return redirect()->route('admin.product')->with('error',__('product.message.create.error'));
    }
    public function create(){
        $template = 'backend.product.product.store';
        $heading = __('product');
        $general = __('general');
        $config = $this->config();
        $method = 'create';
        $dropdown = $this->productCatalogueService->getDropdown(['text' => $heading['create']['field']['catalogues']['label']]);
        $attributeTypes = $this->attributeTypeService->getAttributeType();
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'heading'   => $heading,
                'general'   => $general,
                'config'    => $config,
                'method'    => $method,
                'dropdown'  => $dropdown,
                'attributeTypes'  => $attributeTypes
            ]
        );
    }
    public function index(Request $request){
        // dd($request->input());
        $template = 'backend.product.product.index';
        $products = $this->productService->getData($request, false);
        $heading = __('product');
        $dropdown = $this->productCatalogueService->getDropdown(['text' => $heading['create']['field']['catalogues']['label']]);
        // dd($dropdown);
        $counter = $this->productService->getData($request, true);
        $heading = __('product');
        $general = __('general');
        $config = $this->config();
        $config['script'][] = $this->asset.'/js/customSwitchery.js';
        $config['script'][] = $this->asset.'/js/checkboxList.js';
        $config['script'][] = $this->asset.'/js/setupDeleteMultiple.js';
        $config['config'] = config('apps.general');
        return view(
            'backend.layout',
            [
                'template'    => $template,
                'heading'     => $heading,
                'general'     => $general,
                'config'      => $config,
                'dropdown'    => $dropdown,
                'products'    => $products,
                'counter'     => $counter,
            ]
        );
    }
    private function config(){
        return [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
                $this->asset.'/css/plugins/iCheck/custom.css',
                $this->asset.'/css/plugins/switchery/switchery.css'
            ],
            'script' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                $this->asset.'/js/customSelect2.js',
                $this->asset.'/js/plugins/switchery/switchery.js',
                $this->asset.'/plugins/ckfinder_2/ckfinder.js',
                $this->asset.'/js/finder.js',
                $this->asset.'/plugins/ckeditor/ckeditor.js',
                $this->asset.'/js/seo.js',
                $this->asset.'/js/plugins/iCheck/icheck.min.js',
                $this->asset.'/js/icheckSetup.js',
                $this->asset.'/js/productVariant.js',
                $this->asset.'/js/price.js',
            ]
        ];
    }
}
