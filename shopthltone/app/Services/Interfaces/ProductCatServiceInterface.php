<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface ProductCatServiceInterface{
    public function getProductCatalogues();
    public function create(Request $request);
    
}