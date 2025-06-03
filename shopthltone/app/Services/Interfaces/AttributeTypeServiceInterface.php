<?php
namespace App\Services\Interfaces;

interface AttributeTypeServiceInterface
{
    public function remove($id);
    public function update($id, $request);
    public function create($request);
    public function getAttributeType($id = '');
    public function getData($request, $counter = false, $join = []);
}