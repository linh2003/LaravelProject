<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface MenuCatalogueServiceInterface
{
    public function create(Request $request);
}