<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface PostCatServiceInterface{
    public function getPostCatalogues();
    public function create(Request $request);
    public function update($id,Request $req);
    public function destroy($id);
}