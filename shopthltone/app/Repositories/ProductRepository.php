<?php
namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $product){
        $this->model = $product;
    }
    public function getProductById(int $id=0, int $language_id=0){
        return $this->model->select(
            [
                'products.id',
                'products.follow',
                'products.image',
                'products.album',
                'products.publish',
                'tb2.name',
                'tb2.description',
                'tb2.canonical',
                'tb2.content',
                'tb2.meta_title',
                'tb2.meta_keyword',
                'tb2.meta_desc',
            ]
        )->join('product_languages as tb2','tb2.product_id','=','products.id')
        ->with(
            ['product_catalogues', 
                'product_variants' => function($query) use ($language_id) {
                    $query->with(['attributes' => function($query) use ($language_id){
                        $query->with(['attribute_languages' => function($query) use ($language_id){
                            $query->where('language_id', '=', $language_id);
                        }]);
                    }]);
                }
            ]
        )
        ->where('tb2.language_id','=',$language_id)
        ->findOrFail($id);
    }
    
}