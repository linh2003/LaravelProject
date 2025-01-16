<?php
namespace App\Repositories\Interfaces;

interface PostCatRepositoryInterface
{
    public function getProductCatalogueById(int $id=0, int $language_id=0);
    
}