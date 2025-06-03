<?php
namespace App\Services\Interfaces;

interface RoleServiceInterface
{
    public function create($request);
    public function getData($request, $counter = false);
}