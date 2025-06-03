<?php
namespace App\Services\Interfaces;
interface UserServiceInterface
{
    public function getAll($request, $counter = false);
}