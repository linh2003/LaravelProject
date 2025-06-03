<?php
namespace App\Services\Interfaces;
interface ProductServiceInterface
{
    public function getProduct($id);
    public function getData($request, $counter, $catId = 0);
    public function create($request);
}