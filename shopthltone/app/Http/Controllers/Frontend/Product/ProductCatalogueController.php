<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface as ProductCatRepository;
use App\Services\Interfaces\ProductServiceInterface as ProductService;

class ProductCatalogueController extends FrontendController
{
    protected $productCatRepository;
    protected $productService;
    public function __construct(ProductCatRepository $productCatRepository, ProductService $productService){
        parent::__construct();
        $this->productCatRepository = $productCatRepository;
        $this->productService = $productService;
    }
    public function index($id, $request, $page = 1){
        $system = $this->configSystem();
        $cat = $this->productCatRepository->getProductCatalogue($id, $this->language);
        $seo = setupSeo($cat);
        // dd($seo);
        $breadcrumb = $this->productCatRepository->breadcrumb($cat, $cat->lft, $cat->rgt, $this->language);
        $product = $this->productService->getData($request, false, $cat->id, $page, $cat->canonical);
        $ids = $product->pluck('id')->toArray();
        
        $products = $this->productService->combineProductAndPromotion($product, $ids);
        // dd($products);
        $template = 'frontend.product.catalogue.index';
        $config = __('frontend.productcat');
        return view('frontend.layout', [
            'template' => $template,
            'cat' => $cat,
            'system' => $system,
            'seo' => $seo,
            'breadcrumb' => $breadcrumb,
            'config' => $config,
            'products' => $products,
        ]);
    }
}
