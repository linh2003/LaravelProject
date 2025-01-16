<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface ProductServiceInterface{
    public function create(Request $request);
    
}