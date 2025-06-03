<?php
namespace App\Repositories;

use App\Models\ProductVariant;
use App\Repositories\Interfaces\ProductVariantRepositoryInterface;
use App\Repositories\BaseRepository;

class ProductVariantRepository extends BaseRepository implements ProductVariantRepositoryInterface
{
    public function __construct(ProductVariant $productVariant){
        $this->model = $productVariant;
    }
    // public function combineVariantAndPromotion($selectRaw = '', $join = [], $where = [], $whereRaw = [], $groupBy = [], $orderBy = []){
    //     // dd($selectRaw);
    //     $query = $this->model->selectRaw($selectRaw);
    //     foreach ($join as $k => $it) {
    //         $query->join($it[0], $it[1], $it[2], $it[3]);
    //     }
        
    //     foreach ($where as $key => $item) {
    //         $query->where($item[0], $item[1], $item[2]);
    //     }
    //     foreach ($whereRaw as $val) {
    //         $query->whereRaw($val[0], $val[1]);
    //     }
        
    //     $query->groupBy($groupBy); 
    //     $query->orderBy($orderBy);
    //     return $query->get();
    //     // dd($query->toSql());
    // }
}