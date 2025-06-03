<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCatalogueStoreRequest;
use Illuminate\Http\Request;
use App\Http\Requests\ProductCatalogueUpdateRequest;
use App\Http\Requests\ProductCatDelRequest;
use App\Services\Interfaces\ProductCatalogueServiceInterface as ProductCatalogueService;

class ProductCatalogueController extends BackendController
{
    protected $productCatalogueService;
    public function __construct(ProductCatalogueService $productCatalogueService)
    {
        parent::__construct();
        $this->productCatalogueService = $productCatalogueService;
    }
    public function remove($id, ProductCatDelRequest $req){
        if($this->productCatalogueService->remove($id)){
            return redirect()->route('product.catalogue.create')->with('success', __('productcatalogue.message.delete.success'));
        }
        return redirect()->route('product.catalogue.create')->with('error', __('productcatalogue.message.delete.error'));
    }
    public function update($id, ProductCatalogueUpdateRequest $request){
        if ($this->productCatalogueService->update($id, $request)) {
            return redirect()->route('product.catalogue.create')->with('success',__('productcatalogue.message.update.success'));
        }
        return redirect()->route('product.catalogue.create')->with('error',__('productcatalogue.message.update.error'));
    }
    public function edit($id){
        $template = 'backend.product.catalogue.store';
        $heading = __('productcatalogue');
        $general = __('general');
        $config = $this->config();
        $method = 'update';
        $data = $this->productCatalogueService->getProductCatalogue($id);
        $album = $this->productCatalogueService->getAlbum($id);
        $dropdown = $this->productCatalogueService->getDropdown(['text' => $heading['create']['field']['parent']['optionDefault']]);
        $nestable = $this->productCatalogueService->getNestable($id);
        return view(
            'backend.layout',
            [
                'template' => $template,
                'heading' => $heading,
                'general' => $general,
                'config' => $config,
                'method' => $method,
                'data' => $data,
                'album' => $album,
                'dropdown' => $dropdown,
                'nestable' => $nestable,
            ]
        );
    }
    public function store(ProductCatalogueStoreRequest $request){
        if ($this->productCatalogueService->create($request)) {
            return redirect()->route('product.catalogue.create')->with('success',__('productcatalogue.message.create.success'));
        }
        return redirect()->route('product.catalogue.create')->with('error',__('productcatalogue.message.create.error'));
    }
    public function create(){
        $template = 'backend.product.catalogue.store';
        $heading = __('productcatalogue');
        $general = __('general');
        $config = $this->config();
        $method = 'create';
        $dropdown = $this->productCatalogueService->getDropdown(['text' => $heading['create']['field']['parent']['optionDefault']]);
        $nestable = $this->productCatalogueService->getNestable();
        return view(
            'backend.layout',
            [
                'template' => $template,
                'heading' => $heading,
                'general' => $general,
                'config' => $config,
                'method' => $method,
                'dropdown' => $dropdown,
                'nestable' => $nestable,
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
                $this->asset.'/plugins/ckfinder_2/ckfinder.js',
                $this->asset.'/js/finder.js',
                $this->asset.'/plugins/ckeditor/ckeditor.js',
                $this->asset.'/js/seo.js',
                // $this->asset.'/js/plugins/nestable/jquery.nestable.js',
                // $this->asset.'/js/nestableCustom.js',
            ]
        ];
    }
}
