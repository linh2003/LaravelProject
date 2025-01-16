<?php
namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface AttributeTypeServiceInterface{
    public function getAttributeTypes(Request $request, $pagination=false);
    public function create(Request $request);
    public function update($id,Request $request);
    public function destroy($id);
}