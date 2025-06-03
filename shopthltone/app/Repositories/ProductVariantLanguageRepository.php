<?php
namespace App\Repositories;

use App\Models\ProductVariantLanguage;
use App\Repositories\Interfaces\ProductVariantLanguageRepositoryInterface;
use App\Repositories\BaseRepository;

class ProductVariantLanguageRepository extends BaseRepository implements ProductVariantLanguageRepositoryInterface
{
    public function __construct(ProductVariantLanguage $productVariantLanguage){
        $this->model = $productVariantLanguage;
    }
}