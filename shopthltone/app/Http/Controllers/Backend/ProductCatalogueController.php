<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\ProductCatServiceInterface as ProductCatService;
use App\Repositories\Interfaces\ProductCatRepositoryInterface as ProductCatRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Http\Requests\ProductCatStoreRequest;
use App\Http\Requests\ProductCatUpdateRequest;
use App\Http\Requests\DeleteProductCatRequest;
use Illuminate\Support\Facades\DB;
use App\Classes\Nestedsetbie;

class ProductCatalogueController extends Controller
{
    protected $productCatService;
    protected $productCatRepository;
    protected $nestedset;
    protected $language;
    protected $asset;
    public function __construct(ProductCatService $productCatService, ProductCatRepository $productCatRepository)
    {
        $this->productCatService = $productCatService;
        $this->productCatRepository = $productCatRepository;
        $this->language = $this->currentLanguage();
        $this->asset = asset('backend');
        $this->nestedset = new Nestedsetbie([
            'table' => 'product_catalogues',
            'foreignkey' => 'product_catalogue_id',
            'language_id' => $this->currentLanguage()
        ]);
    }
    public function update($id,ProductCatUpdateRequest $req)
    {
        if ($this->productCatService->update($id,$req)) {
            return redirect()->route('product.catalogue.create')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('product.catalogue.create')->with('error','Cập nhật bản ghi thất bại');
    }
    public function edit($id)
    {
        $productCat = $this->productCatRepository->getProductCatalogueById($id,$this->language);
        $config = $this->config();
        $config['heading'] = __('product_catalogue');
        $config['method'] = 'update';
        $dropdown = $this->nestedset->Dropdown();
        $pCat = $this->productCatService->getProductCatalogues();
        $treeCat = $this->handleTreeCat($pCat);
        $album = json_decode($productCat->album);
        $template = 'backend.product.catalogues.store';
        return view(
            'backend.layout',
            [
                'template'      => $template,
                'css'           => $config['css'],
                'scripts'       => $config['js'],
                'heading'       => $config['heading'],
                'method'        => $config['method'],
                'dropdown'      => $dropdown,
                'productCat'    => $productCat,
                'treeCat'       => $treeCat,
                'album'         => $album,
            ]
        );
    }
    public function store(ProductCatStoreRequest $productCatRequest){
        if ($this->productCatService->create($productCatRequest)) {
            return redirect()->route('product.catalogue.create')->with('success',__('product_catalogue.message.create.success'));
        }
        return redirect()->route('product.catalogue.create')->with('error',__('product_catalogue.message.create.error'));
    }
    public function create(){
        $config = $this->config();
        $config['heading'] = __('product_catalogue');
        $config['method'] = 'create';
        $dropdown = $this->nestedset->Dropdown();
        $productCat = $this->productCatService->getProductCatalogues();
        $treeCat = $this->handleTreeCat($productCat);
        // dd($treeCat);
        $template = 'backend.product.catalogues.store';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'css'       => $config['css'],
                'scripts'   => $config['js'],
                'heading'   => $config['heading'],
                'method'    => $config['method'],
                'productCat'=> $productCat,
                'dropdown'  => $dropdown,
                'treeCat'   => $treeCat,
            ]
        );
    }
    private function config(){
        return [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
                $this->asset.'/css/plugins/jQueryUI/jquery-ui.css',
                $this->asset.'/plugins/jsTree/style.min.css',
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                $this->asset.'/js/inspinia.js',
                $this->asset.'/js/customSelect2.js',
                $this->asset.'/plugins/ckfinder_2/ckfinder.js',
                $this->asset.'/plugins/ckeditor/ckeditor.js',
                $this->asset.'/js/finder.js',
                $this->asset.'/js/seo.js',
                $this->asset.'/js/plugins/jsTree/jstree.min.js',
                $this->asset.'/js/customTree.js',
                $this->asset.'/js/customSortAble.js',
            ]
        ];
    }
    private function handleTreeCat($productCat=[])
    {
        $htmlTree = '';
        $level=0;
        // dd($productCat->toArray());
        if($productCat->toArray()['total']){
            foreach($productCat as $k => $pc){
                if($pc->level > $level){
                    $htmlTree .= '<ul>';
                }elseif($pc->level < $level){
                   $htmlTree .= str_repeat('</ul></li>', $level - $pc->level);
                }
                $htmlTree .= '<li class="jstree-open"><a href="'.route("product.catalogue.edit",["id"=>$pc->id]).'">'.$pc->name.'</a>';
                if(($pc->rgt-$pc->lft)==1){
                    $htmlTree .= '</li>';
                }
                $level=$pc->level;
            }
            $htmlTree .= str_repeat('</ul></li>', $level-1);
            $htmlTree .= '</ul>';
        }
        return $htmlTree;
    }
    private function currentLanguage(){
        $lang = DB::table('languages')->where('active','=',1)->value('id');
        return $lang;
    }
}
