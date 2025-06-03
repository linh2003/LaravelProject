<?php
namespace App\Services\Interfaces;
interface ProductCatalogueServiceInterface
{
    public function getProductCatalogue($id);
    public function create($request);
}