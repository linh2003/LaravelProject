<?php
namespace App\Services;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\BaseService;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use App\Repositories\Interfaces\ProductVariantLanguageRepositoryInterface as ProductVariantLanguageRepository;
use App\Repositories\Interfaces\ProductVariantAttributeRepositoryInterface as ProductVariantAttributeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductService extends BaseService implements ProductServiceInterface
{
    protected $productRepository;
    protected $userRepository;
    protected $routerRepository;
    protected $languageId;
    protected $pvlr;
    protected $pvar;
    public function __construct(ProductRepository $productRepository, RouterRepository $routerRepository, ProductVariantLanguageRepository $pvlr, ProductVariantAttributeRepository $pvar){
        $this->productRepository = $productRepository;
        $this->languageId = $this->currentLanguage();
        $this->routerRepository = $routerRepository;
        $this->controllerName = 'ProductController';
        $this->pvlr = $pvlr;
        $this->pvar = $pvar;
    }

    public function create(Request $request){
        DB::beginTransaction();
        try {
            $product = $this->createProduct($request);
            if($product->id > 0){

                $this->updateLanguageForProduct($product, $request);
                $this->updateCatalogueForProduct($product, $request);
                // dd($product->id);
                $this->createRouter($product->id, $request, $this->controllerName, $this->languageId);

                $this->createVariant($product, $request, $this->languageId);
            }
            DB::commit();
            die();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    private function createVariant($product, $request, $languageId){
        $payload = $request->only(['variant', 'productVariant', 'attribute']);

        $variant = $this->createVariantArrray($product, $payload);
        $product->product_variants()->delete();
        $variants = $product->product_variants()->createMany($variant);
        $variantId = $variants->pluck('id');
        // dd($variantId);
        $productVariantLanguage = [];
        $variantAttribute = [];
        $attributesCombines = $this->combineAttribute(array_values($payload['attribute']));
        if (count($variantId)) {
            foreach ($variantId as $key => $val) {
                $productVariantLanguage[] = [
                    'product_variant_id' => $val,
                    'language_id' => $languageId,
                    'name' => $payload['productVariant']['name'][$key],
                ];
                if (count($attributesCombines)) {
                    foreach ($attributesCombines[$key] as $attributeId) {
                        $variantAttribute[] = [
                            'product_variant_id' => $val,
                            'attribute_id' => $attributeId,
                        ];
                    }
                }
            }
        }
        $variantLang = $this->pvlr->createBatch($productVariantLanguage);
        $variantAttr = $this->pvar->createBatch($variantAttribute);
    }
    private function combineAttribute($attributes=[], $index=0)
    {
        if ($index == count($attributes)) {
            return [[]];
        }
        $subCombine = $this->combineAttribute($attributes, $index + 1);
        $combines = [];
        foreach ($attributes[$index] as $key => $val) {
            foreach ($subCombine as $keySub => $valSub) {
                $combines[] = array_merge([$val], $valSub);
            }
        }
        return $combines;
    }
    private function createVariantArrray($product, $payload){
        $variant = [];
        if(isset($payload['variant']['sku']) && count($payload['variant']['sku'])){
            foreach ($payload['variant']['sku'] as $key => $val) {
                $variant[] = [
                    'code' => ($payload['productVariant']['id'][$key]) ?? '',
                    'quantity' => ($payload['variant']['quantity'][$key]) ?? '',
                    'sku' => $val,
                    'price' => ($payload['variant']['price'][$key]) ? $payload['variant']['price'][$key] : '',
                    'barcode' => ($payload['variant']['barcode'][$key]) ?? '',
                    'file' => ($payload['variant']['file'][$key]) ?? '',
                    'path' => ($payload['variant']['path'][$key]) ?? '',
                    'album' => ($payload['variant']['album'][$key]) ?? '',
                    'user_id' => Auth::id()
                ];
            }
        }
        return $variant;
    }
    private function createProduct($request){
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        $payload['album'] = $this->formatAlbum($payload);
        // $payload['price'] = convert_price($payload['price']);
        $payload['attribute_type'] = $request->input('attributeType');
        $payload['attribute_type'] = $this->formatJson($payload, 'attributeType');
        dd($payload);
        $product = $this->productRepository->create($payload);
        return $product;
    }
    private function updateCatalogueForProduct($product, $request)
    {
        $product->product_catalogues()->sync($this->catalogue($request));
    }
    private function catalogue($request)
    {
        $arg = $request->input('catalogue');
        if (!$arg) {
            $arg = [];
        }
        return $arg;
    }
    private function updateLanguageForProduct($product, $request){
        $payload = $request->only($this->payloadLanguage());
        $payload = $this->formatLanguagePayload($payload,$product->id);
        $product->languages()->detach([$payload['language_id'],$product->id]);
        return $this->productRepository->createPivot($product,$payload,'languages');
    }
    private function formatLanguagePayload($payload,$productId)
    {
        $payload['canonical'] = Str::slug($payload['canonical']);
        $payload['language_id'] = $this->currentLanguage();
        $payload['product_id'] = $productId;
        return $payload;
    }
    private function payloadLanguage()
    {
        return ['name','canonical','description','content','meta_title','meta_keyword','meta_desc'];
    }
    private function payload(){
        return [
            'name',
            'publish',
            'follow',
            'image',
            'album',
            'price',
            'code',
            'product_catalogue_id',
            'attributeType'
        ];
    }
    public function getProducts(Request $request, $pagination=false){
        $condition = $request->except('search');
        if($request->integer('publish')){
            $condition['publish'] = $request->integer('publish');
        }
        if (isset($condition['keyword'])) {
            $condition['keyword'] = addslashes($condition['keyword']);
        }
        $condition['where'] = [
            ['tb2.language_id','=',$this->languageId],
        ];
        $perPage = $request->integer('perpage');
        if(!$request->integer('perpage')){
            $perPage = 20;
        }
        $products = $this->productRepository->getDataPagination(
            $this->selected(),
            $condition,
            [
                ['product_languages as tb2', 'tb2.product_id', '=', 'products.id'],
                ['product_catalogue_product as tb3', 'products.id', '=', 'tb3.product_id'],
            ],
            $perPage,
            ['path'=>'admin/product', 'groupBy' => $this->selected()],
            ['product_catalogues'],
            [],
            $pagination,
            ['products.id','DESC']
        );
        return $products;
    }
    private function selected(){
        return [
            'products.id',
            'products.publish',
            'products.order',
            'products.follow',
            'products.image',
            'products.album',
            'tb2.name',
            'tb2.canonical',
        ];
    }
    
}