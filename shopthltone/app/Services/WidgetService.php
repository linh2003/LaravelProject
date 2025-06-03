<?php
namespace App\Services;

use App\Services\BaseService;
use App\Services\Interfaces\WidgetServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WidgetService extends BaseService implements WidgetServiceInterface
{

    public function __construct(){
        
    }
    //Sản phẩm giảm giá
    public function saleProduct(){
        $queryUnion = DB::table('products')->selectRaw('null as variant_id, products.id AS product_id, pl.name as name, MAX(promotions.discount_value) AS max_discount, routers.canonical AS canonical, products.image as image, products.price as price')
            ->join('product_language AS pl', 'pl.product_id', '=', 'products.id')
            ->join('routers', 'routers.module_id', '=', 'products.id')
            ->join('promotion_module AS pm', 'pm.module_id', '=', 'products.id')
            ->join('promotions', 'pm.promotion_id', '=', 'promotions.id')
            ->whereDate('promotions.start', '<=', now())
            ->whereDate('promotions.end', '>', now())
            ->where('routers.controller', '=', 'App\\Http\\Controllers\\Frontend\\Product\\ProductController')
            ->where('products.publish', '=', 1)
            ->where('promotions.status', '=', 1)
            ->whereNotIn('products.id',
                DB::table('product_variants')
                ->selectRaw('DISTINCT product_id')
                ->join('promotion_module AS pm2', 'pm2.module_id', '=', 'product_variants.id')
            )->groupBy(['products.id', 'pl.name', 'routers.canonical']);

        $query = DB::table('product_variants')
        ->selectRaw('product_variants.id AS variant_id, product_variants.product_id, CONCAT(pl.name, " - ", pvl.name) AS name, MAX(promotions.discount_value) AS max_discount, routers.canonical AS canonical, product_variants.album as image, product_variants.price as price')
        ->join('product_language AS pl', 'pl.product_id', '=', 'product_variants.product_id')
        ->join('product_variant_language AS pvl', 'pvl.product_variant_id', '=', 'product_variants.id')
        ->join('routers', 'routers.module_id', '=', 'product_variants.product_id')
        ->join('promotion_module AS pm', 'pm.module_id', '=', 'product_variants.id')
        ->join('promotions', 'pm.promotion_id', '=', 'promotions.id')
        ->whereDate('promotions.start', '<=', now())
        ->whereDate('promotions.end', '>', now())
        ->where('routers.controller', '=', 'App\\Http\\Controllers\\Frontend\\Product\\ProductController')
        ->where('promotions.status', '=', 1)
        ->groupBy(['product_variants.id', 'name', 'routers.canonical'])
        ->union(
            $queryUnion
            );
        $data = $query->get();
        return $data;
    }
    //Sản phẩm đề xuất
    public function popularProduct(){
        //union variant not sale
        $queryUnionVariantNotSale = DB::table('product_variants')
        ->selectRaw('product_variants.id AS variant_id, product_variants.product_id, CONCAT(pl.name, " - ", pvl.name) AS name, null AS max_discount, routers.canonical AS canonical, product_variants.album as image, product_variants.price as price')
        ->join('product_language AS pl', 'pl.product_id', '=', 'product_variants.product_id')
        ->join('product_variant_language AS pvl', 'pvl.product_variant_id', '=', 'product_variants.id')
        ->join('routers', 'routers.module_id', '=', 'product_variants.product_id')
        ->where('routers.controller', '=', 'App\\Http\\Controllers\\Frontend\\Product\\ProductController')
        ->whereNotIn ( 'product_variants.id',
                DB::table('promotion_module')
                ->selectRaw('module_id') )
        ->groupBy(['product_variants.id', 'name', 'routers.canonical'])
		->orderBy('product_variants.id', 'DESC');
        //union product sale
        $queryUnionProductSale = DB::table('products')->selectRaw('null as variant_id, products.id AS product_id, pl.name as name, MAX(promotions.discount_value) AS max_discount, routers.canonical AS canonical, products.image as image, products.price as price')
            ->join('product_language AS pl', 'pl.product_id', '=', 'products.id')
            ->join('routers', 'routers.module_id', '=', 'products.id')
            ->join('promotion_module AS pm', 'pm.module_id', '=', 'products.id')
            ->join('promotions', 'pm.promotion_id', '=', 'promotions.id')
            ->whereDate('promotions.start', '<=', now())
            ->whereDate('promotions.end', '>', now())
            ->where('routers.controller', '=', 'App\\Http\\Controllers\\Frontend\\Product\\ProductController')
            ->where('products.publish', '=', 1)
            ->where('promotions.status', '=', 1)
            ->whereNotIn('products.id',
                DB::table('product_variants')
                ->selectRaw('DISTINCT product_id')
                ->join('promotion_module AS pm2', 'pm2.module_id', '=', 'product_variants.id')
            )->groupBy(['products.id', 'pl.name', 'routers.canonical']);
        //union product not sale
        $queryUnionProductNotSale = DB::table('products')->selectRaw('null as variant_id, products.id AS product_id, pl.name as name, null AS max_discount, routers.canonical AS canonical, products.image as image, products.price as price')
            ->join('product_language AS pl', 'pl.product_id', '=', 'products.id')
            ->join('routers', 'routers.module_id', '=', 'products.id')
            ->where('routers.controller', '=', 'App\\Http\\Controllers\\Frontend\\Product\\ProductController')
            ->where('products.publish', '=', 1)
            ->whereNotIn ('products.id',
                DB::table('promotion_module')
                ->selectRaw('module_id')
            )->groupBy(['products.id', 'pl.name', 'routers.canonical'])
			->orderBy('products.id', 'DESC');
        //union merge
        $query = DB::table('product_variants')
        ->selectRaw('product_variants.id AS variant_id, product_variants.product_id, CONCAT(pl.name, " - ", pvl.name) AS name, MAX(promotions.discount_value) AS max_discount, routers.canonical AS canonical, product_variants.album as image, product_variants.price as price')
        ->join('product_language AS pl', 'pl.product_id', '=', 'product_variants.product_id')
        ->join('product_variant_language AS pvl', 'pvl.product_variant_id', '=', 'product_variants.id')
        ->join('routers', 'routers.module_id', '=', 'product_variants.product_id')
        ->join('promotion_module AS pm', 'pm.module_id', '=', 'product_variants.id')
        ->join('promotions', 'pm.promotion_id', '=', 'promotions.id')
        ->whereDate('promotions.start', '<=', now())
        ->whereDate('promotions.end', '>', now())
        ->where('routers.controller', '=', 'App\\Http\\Controllers\\Frontend\\Product\\ProductController')
        ->where('promotions.status', '=', 1)
        ->groupBy(['product_variants.id', 'name', 'routers.canonical'])
        ->union(
            $queryUnionVariantNotSale
            )->union($queryUnionProductSale)->union($queryUnionProductNotSale);
            // dd($query->toSql());
        $data = $query->get();
        return $data;
    }
}