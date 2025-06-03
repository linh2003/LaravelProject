<?php
namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $product){
        $this->model = $product;
    }
    public function getProductForPromotion($select, $condition, $join, $paginate = 10){
        $query = $this->model->newQuery();
        $query = $query->select($select);
        // dd($condition);
        foreach ($condition as $k => $val) {
            if (is_int($k)) {
                $query->where($val[0], $val[1], $val[2]);
            }else if($k == 'orWhere'){
                $query->where(function($query) use ($condition){
                    foreach($condition['orWhere'] as $key => $it){
                        $query->orWhere($it[0], $it[1], $it[2]);
                    }
                });
            }
        }
        if (isset($condition['whereRaw'])) {
            $query->whereRaw($condition['whereRaw']);
        }
        foreach ($join as $key => $it) {
            $query->leftJoin($it[0], $it[1], $it[2], $it[3]);
        }
        $query->orderBy('products.id', 'DESC');
        // dd($query->toSql());
        return ($paginate > 0) ? $query->paginate($paginate) : $query->get();
        // return $query->get();
    }
    public function getProduct($id, $languageId){
        $column = [
            'id',
            'product_catalogue_id',
            'image',
            'album',
            'code',
            'quantity',
            'price',
            'attribute_type',
            'attribute',
            'variant',
            'publish',
            'follow',
            'order',
            'tb2.name',
            'tb2.description',
            'tb2.content',
            'tb2.meta_title',
            'tb2.meta_keyword',
            'tb2.meta_description',
            'tb2.canonical',
        ];
        $join = ['product_language as tb2', 'products.id', '=', 'tb2.product_id'];
        return $this->model->select($column)
        ->where('tb2.language_id', $languageId)
        ->join($join[0], $join[1], $join[2], $join[3])
        ->find($id);
    }
}