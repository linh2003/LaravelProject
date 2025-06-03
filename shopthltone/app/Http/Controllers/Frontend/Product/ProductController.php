<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Http\Request;
use App\Services\Interfaces\ProductServiceInterface as ProductService;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface as ProductCatalogueRepository;

class ProductController extends FrontendController
{
    protected $productService;
    protected $productRepository;
    protected $pCatRepository;
    public function __construct(ProductService $productService, ProductRepository $productRepository, ProductCatalogueRepository $pCatRepository){
        parent::__construct();
        $this->productService = $productService;
        $this->productRepository = $productRepository;
        $this->pCatRepository = $pCatRepository;
    }
    public function index($id, $request){
        $template = 'frontend.product.product.index';
        $system = $this->configSystem();
        $product = $this->productService->getProductForProductDetail($id);
        // dd($product);
        $cat = $this->pCatRepository->getProductCatalogue($product->catId, $this->language);
        // dd($cat);
        $breadcrumb = $this->productRepository->breadcrumb($cat, $cat->lft, $cat->rgt, $this->language);
        // dd($breadcrumb);
        $seo = setupSeo($product);
        $config = $this->config();
        return view('frontend.layout', [
            'template' => $template,
            'system' => $system,
            'seo' => $seo,
            'breadcrumb' => $breadcrumb,
            'config' => $config,
            'product' => $product,
            'productId' => $id,
        ]);
    }
    private function config(){
        return [
            'script' => [
                $this->asset.'frontend/resources/library/js/swiper-bundle.min.js',
                $this->asset.'frontend/js/product.js',
            ]
        ];
    }
}
