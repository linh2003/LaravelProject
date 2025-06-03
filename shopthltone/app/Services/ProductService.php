<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Services\BaseService;
use App\Services\Interfaces\ProductServiceInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Repositories\Interfaces\ProductVariantRepositoryInterface as ProductVariantRepository;
use App\Repositories\Interfaces\ProductVariantAttributeRepositoryInterface as ProductVariantAttributeRepository;
use App\Repositories\Interfaces\ProductVariantLanguageRepositoryInterface as ProductVariantLanguageRepository;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use App\Repositories\Interfaces\PromotionRepositoryInterface as PromotionRepository;
use App\Repositories\Interfaces\AttributeTypeRepositoryInterface as AttributeTypeRepository;
use App\Repositories\Interfaces\AttributeRepositoryInterface as AttributeRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;

class ProductService extends BaseService implements ProductServiceInterface
{
    protected $productRepository;
    protected $pVariantRepository;
    protected $pVariantAttrRepository;
    protected $pVariantLanguageRepository;
    protected $controllerName;
    protected $promotionRepository;
    protected $atTypeRepository;
    protected $attrRepository;
    public function __construct(ProductRepository $productRepository, ProductVariantRepository $pVariantRepository, ProductVariantAttributeRepository $pVariantAttrRepository, ProductVariantLanguageRepository $pVariantLanguageRepository, RouterRepository $routerRepository, PromotionRepository $promotionRepository, AttributeTypeRepository $atTypeRepository, AttributeRepository $attrRepository){
        parent::__construct($routerRepository);
        $this->productRepository = $productRepository;
        $this->pVariantRepository = $pVariantRepository;
        $this->pVariantAttrRepository = $pVariantAttrRepository;
        $this->pVariantLanguageRepository = $pVariantLanguageRepository;
        $this->promotionRepository = $promotionRepository;
        $this->atTypeRepository = $atTypeRepository;
        $this->attrRepository = $attrRepository;
        $this->controllerName = 'Product\ProductController';
    }
    public function getAlbum($id){
        $ret = $this->productRepository->findById($id, ['album']);
        return json_decode($ret->album, true);
    }
    public function getProduct($id){
        $product = $this->productRepository->getProduct($id, $this->languageCurent->id);
        return $product;
    }
    public function changeStatusAll($request){
        $ids = $request['modelId'];
        // dd($ids);
        $condition = [$request['field'] => $request['value']];
        return $this->productRepository->updateWhereIn('id', $ids, $condition);
    }
    public function changeStatus($request){
        DB::beginTransaction();
        try {
            $id = $request['modelId'];
            $field = $request['field'];
            $value = ($request['value'] == 1) ? config('apps.general.unpublish') : config('apps.general.publish');
            // dd($value);
            $condition = [$field => $value];
            $this->productRepository->update($id, $condition);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function parserAttribute($attribute){
        $general = config('apps.general');
        $atTypes = array_keys(json_decode($attribute, true));
        // dd($atTypes);
        $attrs = array_merge(...array_values(json_decode($attribute, true)));
        $select = ['id', 'tb2.name'];
        $condition = [
            ['attribute_types.publish', '=', $general['publish']],
            ['tb2.language_id', '=', $this->languageCurent->id],
        ];
        // $whereIn = implode(',', $atTypes);
        $join = [
            ['attribute_type_language as tb2', 'attribute_types.id', '=', 'tb2.attribute_type_id']
        ];
        $attributeTypes = $this->atTypeRepository->loadAttributeType($select, $condition, $atTypes, $join);
        // dd($attributeTypes);
        //attribute
        $selectAttr = ['id', 'tb3.attribute_type_id', 'tb2.name'];
        $conditionAttr = [
            ['attributes.publish', '=', $general['publish']],
            ['tb2.language_id', '=', $this->languageCurent->id],
        ];
        $joinAttr = [
            ['attribute_language as tb2', 'attributes.id', '=', 'tb2.attribute_id'],
            ['attribute_type_attribute as tb3', 'attributes.id', '=', 'tb3.attribute_id'],
        ];
        $attributes = $this->attrRepository->loadAttribute($selectAttr, $conditionAttr, $attrs, $joinAttr);
        foreach ($attributeTypes as $k => $it) {
            $add = [];
            foreach ($attributes as $key => $attr) {
                if($it->id == $attr->attribute_type_id){
                    $add[] = $attributes[$key];
                }
            }
            $attributeTypes[$k]->attributes = $add;
        }
        return $attributeTypes;
    }
    public function getProductForProductDetail($id, $code = ''){
        $general = config('apps.general');
        $select = [ 
            DB::raw("COALESCE(pv.id, products.id) AS id"), 
            "products.product_catalogue_id as catId",
            DB::raw("CONCAT(tb2.name, ' - ', COALESCE(pvl.name,'DE') ) AS name"), 
            DB::raw('COALESCE(pvl.name, null) AS variant_name'), 
            "products.image AS image",
            DB::raw('COALESCE(pv.quantity, products.quantity) AS quantity'), 
            DB::raw('COALESCE(pv.price, products.price) AS price'), 
            DB::raw('COALESCE(pv.code, null) AS code'), 
            DB::raw('null AS max_discount'),
            DB::raw('COALESCE(pv.sku, products.code) AS sku'), 
            DB::raw('COALESCE(pv.album, products.album) AS album'), 
            "products.attribute",
            "tb2.description",
            "tb2.canonical",
            "tb2.content",
            "tb2.meta_title",
            "tb2.meta_keyword",
            "tb2.meta_description",
        ];
        $condition = [
            'whereRaw' => '(pv.publish = '.$general['publish'].' AND pv.price > 0 AND pv.product_id = '.$id.') OR (products.id = '.$id.' AND products.publish = '.$general['publish'].')'
        ];
        $join = [
            ['product_language as tb2', 'products.id', '=', 'tb2.product_id'],
            ['product_variants as pv', 'products.id', '=', 'pv.product_id'],
            ['product_variant_language as pvl', 'pv.id', '=', 'pvl.product_variant_id'],
        ];
        $product = $this->productRepository->getProductForPromotion($select, $condition, $join, 0);

        $selectRaw = 'pm.module_id as module_id, MAX(promotions.discount_value) AS max_discount';
        $conditionPro = [
            ['promotions.status', '=', $general['publish']],
            ['pm.module', '=', 'product'],
            ['promotions.start', '<=', now()],
            ['promotions.end', '>', now()],
        ];
        $join = [
            ['promotion_module as pm', 'pm.promotion_id', '=', 'promotions.id']
        ];
        $groupBy = 'module_id';
        $promotions = $this->promotionRepository->getMaxDiscount($selectRaw, $conditionPro, $join, $groupBy);
        $index = 0;
        if(count($product) > 1){
            foreach ($product as $k => $item) {
                $attr = $this->parserAttribute($item->attribute);
                $product[$k]->attributes = $attr;
                if($item->code == $code){
                    $index = $k;
                }
                foreach ($promotions as $key => $val) {
                    if ($item->id == $val->module_id) {
                        $product[$k]->max_discount = $promotions[$key]->max_discount;
                    }
                }
            }
        }
        // dd($product);
        // dd($index);
        return ($index == 0) ? $product->first() : $product[$index];
    }
    public function getProductForPromotion($where = ''){
        $general = config('apps.general');
        $select = [ 
            "products.image",
            DB::raw("CONCAT(tb2.name, ' - ', COALESCE(tb4.name,'DE') ) AS name"), 
            DB::raw('COALESCE(tb3.id, products.id) AS id'), 
            DB::raw('COALESCE(tb3.quantity, products.quantity) AS quantity'), 
            DB::raw('COALESCE(tb3.price, products.price) AS price'), 
            DB::raw('COALESCE(tb3.sku, products.code) AS sku'), 
            DB::raw('COALESCE(tb3.album, "") AS album'), 
        ];
        $condition = [
            ['tb2.language_id', '=', $this->languageCurent->id],
            ['products.publish', '=', $general['publish']],
            ['tb3.publish', '=', $general['publish']],
            ['tb3.price', '>', 0],
            ['tb4.language_id', '=', $this->languageCurent->id],
        ];
        if (!empty($where) && isset($where["keyword"])) {
            $condition['orWhere'] = [
                ['tb2.name', 'LIKE', '%'.$where["keyword"].'%'],
                ['tb4.name', 'LIKE', '%'.$where["keyword"].'%']
            ];
        }
        // dd($condition);
        $join = [
            ['product_language as tb2', 'products.id', '=', 'tb2.product_id'],
            ['product_variants as tb3', 'products.id', '=', 'tb3.product_id'],
            ['product_variant_language as tb4', 'tb3.id', '=', 'tb4.product_variant_id'],
        ];
        return $this->productRepository->getProductForPromotion($select, $condition, $join, $general['paginate'][0]);
        // dd($ret);
    }
    public function combineProductAndPromotion($product, $ids = []){
        // dd($product);
        $param = implode(",", array_fill(0, count($ids), '?'));
        // dd($ids);
        $select = [
            "products.id AS id", 
            "products.image AS image", 
            "tb2.name AS name", 
            "products.price", 
            "products.quantity", 
            "tb2.canonical", 
            DB::raw("MAX(promotions.discount_value) AS max_discount")
        ];
        $condition = [
            'where' => [
                ['products.publish', '=', config('apps.general.publish')],
                ['promotions.status', '=', config('apps.general.publish')],
                ['promotions.start', '<=', now()],
                ['promotions.end', '>', now()],
                ['promotions.end', '>', now()]
            ]
        ];
        $join = [
            ['product_language AS tb2', 'tb2.product_id', '=', 'products.id'],
            ['promotion_module as pm', 'pm.module_id', '=', 'products.id'],
            ['promotions', 'pm.promotion_id', '=', 'promotions.id'],
        ];
        $whereRaw = [
            ['pm.module_id IN ('.$param.') ', $ids]
        ];
        $groupBy = ['id', 'name', 'price', 'tb2.canonical'];
        $orderBy = ['id', 'DESC'];
        $promotion = $this->productRepository->getData($select, $condition, false, $join, '', $whereRaw, [], $orderBy, $groupBy);
        //Gán product có promotion nếu id bằng nhau
        foreach ($product as $key => $p) {
            foreach ($promotion as $k => $it) {
                if ($p->id == $it->id) {
                    $product[$key] = $promotion[$k];
                }
            }
        }
        // dd($product);
        return $product;
    }
    public function getData($request, $counter, $catId = 0, $page = 1, $extend = ''){
        if ($catId > 0) {
            Paginator::currentPageResolver(function() use ($page){
                return $page;
            });
        }
        $select = [
            'id',
            'products.product_catalogue_id',
            'image',
            'price',
            'quantity',
            'code',
            'publish',
            'follow',
            'tb2.name',
            'tb2.canonical',
        ];
        $join = [
            ['product_language as tb2', 'products.id', '=', 'tb2.product_id'],
            ['product_catalogue_product as tb3', 'products.id', '=', 'tb3.product_id'],
        ];
        $catId = $catId == 0 ? intval($request->input('product_catalogue_id')) : $catId;
        $condition = [
            'keyword' => $request->input('keyword'),
            'product_catalogue_id' => $catId,
            'publish' => $request->input('publish') ?? config('apps.general.publish'),
            'perpage' => $request->input('perpage'),
            'where' => [['tb2.language_id', '=', $this->languageCurent->id]]
        ];
        // dd($condition);
        $rawQuery = [];
        if($catId > 0){
            $rawQuery = $this->whereRawQuery($catId, $this->languageCurent->id);
        }
        $orderBy = ['id', 'DESC'];
        $groupBy = ['products.id', 'tb2.name', 'tb2.canonical'];
        //$path = $extend ?? 'product/index';
        // dd($extend);
        return $this->productRepository->getData($select, $condition, $counter, $join, $extend, $rawQuery, [], $orderBy, $groupBy);
    }
    private function whereRawQuery($model, $languageId){
        $query = [
            ['tb3.product_catalogue_id IN (
                    SELECT id
                    FROM product_catalogues
                    JOIN product_catalogue_language as pcl
                    WHERE ( lft >= (
                    SELECT lft FROM product_catalogues WHERE id = ?
                    ) AND rgt <= (SELECT rgt FROM product_catalogues WHERE id = ?) ) AND pcl.language_id = '.$languageId.' 
                )', [$model, $model]
            ]
        ];
        return $query;
    }
    public function deleteAll($ids){
        // dd($ids);
        DB::beginTransaction();
        try {
            $select = ['id'];
            $condition = [
                'wherein' => ['id' => $ids]
            ];
            // dd($condition);
            $flag = $this->productRepository->destroyCondition($select, $condition, []);
            // dd($flag);
            if ($flag) {
                $this->deleteMultipleRouter($ids, $this->controllerName);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function remove($id){
        DB::beginTransaction();
        try {
            $flag = $this->productRepository->destroy($id);
            // dd($flag);
            if ($flag) {
                // dd('delete router');
                $this->deleteRouter($id, $this->controllerName);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function update($id, $request){
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload());
            $product = $this->updateProduct($id, $request, $payload);
            // dd($flag);
            if($product){
                //Thêm dữ liệu vào table product catalogue language
                $this->updatePayloadLanguage($request, $product, $this->languageCurent->id);
                //Sync dữ liệu vào product catalogue product
                $this->updateCatalogueForProduct($request, $product);
                // dd(123);
                //Thêm dữ liệu attribute_type, attribute, variant
                $this->updateVariantForProduct($request, $product);
                //Thêm dữ liệu vào router
                $this->updateRouter($request, $id, $this->controllerName);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function create($request){
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload());
            // dd($request->input());
            $product = $this->createProduct($request, $payload);
            // dd($product);
            if($product->id > 0){
                //Thêm dữ liệu vào table product language
                $this->updatePayloadLanguage($request, $product, $this->languageCurent->id);
                //Sync dữ liệu vào product catalogue product
                $this->updateCatalogueForProduct($request, $product);
                //Thêm dữ liệu attribute_type, attribute, variant
                $this->updateVariantForProduct($request, $product);
                //Thêm dữ liệu vào router
                $this->createRouter($request, $product->id, $this->controllerName);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    private function updateVariantForProduct($request, $model){
        $model->product_variants()->delete();
        $apply_variant = $request->only('apply_variant');
        // dd($apply_variant);
        if ($apply_variant) {
            $variant = $request->only('variant');
            // dd($variant);
            if (isset($variant['variant']) && count($variant['variant']) > 0 && isset($variant['variant']['id']) && count($variant['variant']['id']) > 0) {
                $len = count($variant['variant']['id']);
                // dd($len);
                $payload = [];
                for ($i = 0; $i < $len; $i++) {
                    $ret = [];
                    $attrId = $variant['variant']['id'][$i] ?? ''; 
                    $code = sortString($attrId); 
                    $album = json_encode($variant['variant']['album'][$i]);
                    $payload[] = [
                        'album' => $album,
                        'price' => convertPrice($variant['variant']['price'][$i]),
                        'quantity' => intval($variant['variant']['quantity'][$i]),
                        'sku' => $variant['variant']['sku'][$i],
                        'code' => $code,
                        'name' => $variant['variant']['name'][$i],
                        'filename' => $variant['variant']['filename'][$i],
                        'fileurl' => $variant['variant']['fileurl'][$i],
                        'product_id' => $model->id,
                        'user_id' => Auth::id(),
                    ];
                }
                // dd($payload);
                $productVariant = $this->productRepository->createMany($model, $payload, 'product_variants');
                // dd($productVariant);
                $pVariant = $productVariant->pluck('id')->toArray();
                $combineVariantAttr = $this->combineArrray($pVariant, $variant['variant']['id'], 'attribute_id');
                // dd($combineVariantAttr);
                $this->pVariantAttrRepository->createBatch($combineVariantAttr);
                $combineVariantLanguage = [];
                foreach ($pVariant as $k => $value) { 
                    $combineVariantLanguage[] = [
                        'product_variant_id' => $value,
                        'language_id' => $this->languageCurent->id,
                        'name' => $variant['variant']['name'][$k]
                    ];
                }
                // dd($combineVariantLanguage);
                $this->pVariantLanguageRepository->createBatch($combineVariantLanguage);
                // dd(123);
            }
        }
        // dd(345);
    }
    private function combineArrray($pVariant, $arr, $key = ''){
        $ret = [];
        foreach ($pVariant as $k => $value) {
            $ids = explode(', ', $arr[$k]);
            for ($i = 0; $i < count($ids); $i++) { 
                $ret[] = [
                    'product_variant_id' => $value,
                    $key => intval($ids[$i])
                ];
            }
        }
        return $ret;
    }
    private function updateCatalogueForProduct($request, $model){
        $payloadCatalogue = $this->formatPayloadCatalogue($request);
        $this->productRepository->syncData($model, $payloadCatalogue, 'product_catalogues');
    }
    private function updateProduct($id, $request, $payload){
        $payloadFormat = $this->formatPayload($request, $payload);
        return $this->productRepository->update($id, $payloadFormat);
    }
    private function createProduct($request, $payload){
        $payloadFormat = $this->formatPayload($request, $payload);
        return $this->productRepository->create($payloadFormat);
    }
    private function updatePayloadLanguage($request, $product, $langugeId){
        $payloadLanguage = $this->formatPayloadLanguage($request);
        $product->languages()->detach([$product->id, $langugeId]);
        $this->productRepository->createPivot($product, $payloadLanguage, 'languages');
    }
    private function formatPayloadCatalogue($request){
        $payloadCatalogue = $request->only(['product_catalogue_id', 'catalogues']);
        // dd($payloadCatalogue);
        $arr = isset($payloadCatalogue['catalogues']) ? $payloadCatalogue['catalogues'] : [];
        $arr[] = $payloadCatalogue['product_catalogue_id'];
        $catalogues = array_unique($arr);
        return $catalogues;
    }
    private function formatPayloadLanguage($request){
        $payloadLanguage = $request->only($this->payloadLanguage());
        $payloadLanguage['canonical'] = Str::slug($payloadLanguage['canonical']);
        $payloadLanguage['language_id'] = $this->languageCurent->id;
        return $payloadLanguage;
    }
    private function formatPayload($request, $payload){
        $payload['price'] = convertPrice($payload['price']);
        $payload['album'] = $this->formatAlbum($payload);
        $apply_variant = $request->only('apply_variant');
        if($apply_variant && isset($payload['attribute']) && isset($payload['variant'])){
            $atType = array_keys($payload['attribute']);
            $payload['attribute_type'] = $this->formatProductVariant($atType);
            $payload['attribute'] = $this->formatProductVariant($payload['attribute']);
            $payload['variant'] = $this->formatProductVariant($payload['variant']);
        }else{
            $payload['attribute_type'] = '';
            $payload['attribute'] = '';
            $payload['variant'] = '';
        }
        $payload['user_id'] = Auth::id();
        // dd($payload);
        return $payload;
    }
    private function formatProductVariant($payload){
        return ($payload != '') ? json_encode($payload) : '';
    }
    private function payloadLanguage(){
        return [
            'name',
            'description',
            'content',
            'meta_title',
            'meta_description',
            'meta_keyword',
            'canonical',
        ];
    }
    private function payload(){
        return [
            'product_catalogue_id',
            'image',
            'album',
            'code',
            'quantity',
            'price',
            'publish',
            'follow',
            'attribute',
            'variant',
        ];
    }
}