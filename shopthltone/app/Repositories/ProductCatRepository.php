<?php
namespace App\Repositories;

use App\Models\ProductCatalogue;
use App\Repositories\Interfaces\ProductCatRepositoryInterface;
use App\Repositories\BaseRepository;

class ProductCatRepository extends BaseRepository implements ProductCatRepositoryInterface
{
    public function __construct(ProductCatalogue $productCat){
        $this->model = $productCat;
    }
    public function getProductCatalogueById(int $id=0, int $language_id=0)
    {
        return $this->model->select(
            [
                'product_catalogues.id',
                'product_catalogues.parentid',
                'product_catalogues.follow',
                'product_catalogues.image',
                'product_catalogues.album',
                'product_catalogues.publish',
                'tb2.name',
                'tb2.description',
                'tb2.canonical',
                'tb2.content',
                'tb2.meta_title',
                'tb2.meta_keyword',
                'tb2.meta_desc',
            ]
        )->join('product_catalogue_languages as tb2','tb2.product_catalogue_id','=','product_catalogues.id')
        ->where('tb2.language_id','=',$language_id)
        ->findOrFail($id);
    }
    
}