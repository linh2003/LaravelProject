<?php
namespace App\Repositories\Interfaces;
interface ProductRepositoryInterface
{
    public function getProduct($id, $languageId);
}