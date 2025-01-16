<?php
namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function getProductById(int $id=0, int $language_id=0);
    
}