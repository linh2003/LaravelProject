<?php
namespace App\Repositories;

use App\Models\ProductCatalogue;
use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface;
use App\Repositories\BaseRepository;
class ProductCatalogueRepository extends BaseRepository implements ProductCatalogueRepositoryInterface
{
    public function __construct(ProductCatalogue $productCatalogue){
        $this->model = $productCatalogue;
    }
    public function getProductCatalogue($id, $languageId){
        $column = [
            'id',
            'parentid',
            'lft',
            'rgt',
            'image',
            'album',
            'publish',
            'follow',
            'order',
            'tb2.name',
            'tb2.description',
            'tb2.content',
            'tb2.meta_title',
            'tb2.meta_keyword',
            'tb2.meta_desc',
            'tb2.canonical',
        ];
        $join = ['product_catalogue_language as tb2', 'product_catalogues.id', '=', 'tb2.product_catalogue_id'];
        return $this->model->select($column)
        ->where('tb2.language_id', $languageId)
        ->join($join[0], $join[1], $join[2], $join[3])
        ->find($id);
    }
    
}