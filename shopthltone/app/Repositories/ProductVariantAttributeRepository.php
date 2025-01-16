<?php
namespace App\Repositories;

use App\Models\ProductVariantAttribute;
use App\Repositories\Interfaces\ProductVariantAttributeRepositoryInterface;
use App\Repositories\BaseRepository;

class ProductVariantAttributeRepository extends BaseRepository implements ProductVariantAttributeRepositoryInterface
{
    public function __construct(ProductVariantAttribute $productVariantAttribute){
        $this->model = $productVariantAttribute;
    }

    
}