<?php
namespace App\Repositories\Interfaces;
interface ProductCatalogueRepositoryInterface
{
    public function getProductCatalogue($id, $languageId);
}