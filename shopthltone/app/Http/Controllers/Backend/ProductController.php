<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\ProductServiceInterface as ProductService;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Repositories\Interfaces\AttributeTypeRepositoryInterface as AttributeTypeRepository;
use Illuminate\Support\Facades\Auth;
use App\Classes\Nestedsetbie;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends Controller
{
    protected $productService;
    protected $productRepository;
    protected $userRepository;
    protected $atTypeRepository;
    protected $nestedset;
    protected $language;
    protected $asset;
    public function __construct(ProductService $productService, ProductRepository $productRepository, AttributeTypeRepository $atTypeRepository){
        $this->productService = $productService;
        $this->productRepository = $productRepository;
        $this->atTypeRepository = $atTypeRepository;
        $this->language = $this->currentLanguage();
        $this->asset = asset('backend');
        $this->nestedset = new Nestedsetbie([
            'table' => 'product_catalogues',
            'foreignkey' => 'product_catalogue_id',
            'language_id' => $this->currentLanguage()
        ]);
    }

    public function edit($id){
        $config = $this->config();
        $config['js'][] = $this->asset.'/js/variant.js';
        $product = $this->productRepository->getProductById($id, $this->language);
        dd($product);
        $dropdown = $this->nestedset->Dropdown();
        // dd($dropdown);
        $attrs = $this->atTypeRepository->getAll();
        $config['heading'] = __('product');
        $config['method'] = 'update';
        $uidLogged = Auth::id();
        $template = 'backend.product.store';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'css'       => $config['css'],
                'scripts'   => $config['js'],
                'heading'   => $config['heading'],
                'method'    => $config['method'],
                'uidLogged' => $uidLogged,
                'dropdown'  => $dropdown,
                'attrs'     => $attrs,
                'product'  => $product,
            ]
        );
    }

    public function store(ProductStoreRequest $productRequest){
        // dd($productRequest);
        if ($this->productService->create($productRequest)) {
            return redirect()->route('admin.product')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('admin.product')->with('error','Thêm mới bản ghi thất bại');
    }

    public function create(){
        $config = $this->config();
        $config['js'][] = $this->asset.'/js/variant.js';
        $dropdown = $this->nestedset->Dropdown();
        // $treeCat = $this->handleTreeCat($postCat);
        $attrs = $this->atTypeRepository->getAll();
        $config['heading'] = __('product');
        $config['method'] = 'create';
        $uidLogged = Auth::id();
        $template = 'backend.product.store';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'css'       => $config['css'],
                'scripts'   => $config['js'],
                'heading'   => $config['heading'],
                'method'    => $config['method'],
                'uidLogged' => $uidLogged,
                'dropdown'  => $dropdown,
                'attrs'     => $attrs,
            ]
        );
    }

    public function index(Request $request)
    {
        // $this->authorize('modules','admin.product');
        $config = [];
        $config['css'][] = $this->asset.'/css/plugins/switchery/switchery.css';
        $config['js'][] = $this->asset.'/js/plugins/switchery/switchery.js';
        $config['js'][] = $this->asset.'/js/customCheckboxStatus.js';
        $config['js'][] = $this->asset.'/js/customSwitchery.js';
        $products = $this->productService->getProducts($request);
        $counter = $this->productService->getProducts($request,true);
        $template = 'backend.product.index';
        return view(
            'backend.layout',
            [
                'css'       => $config['css'],
                'scripts'   => $config['js'],
                'template' => $template,
                'counter' => $counter,
                'products' => $products,
            ]
        );
    }
    private function currentLanguage(){
        $lang = DB::table('languages')->where('active','=',1)->value('id');
        return $lang;
    }
    private function config()
    {
         return [
            'css' => [
                $this->asset.'/css/plugins/jasny/jasny-bootstrap.min.css',
                $this->asset.'/css/plugins/switchery/switchery.css',
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
                $this->asset.'/js/plugins/switchery/switchery.js',
                $this->asset.'/js/customSwitchery.js',
                
            ]
        ];
    }
}
