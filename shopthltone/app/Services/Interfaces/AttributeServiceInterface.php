<?php
namespace App\Services\Interfaces;

interface AttributeServiceInterface
{
    public function remove($id);
    public function update($id, $request);
    public function create($request);
    public function getData($request, $counter = false, $join = []);
}