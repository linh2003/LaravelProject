<?php
namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface
{
    public function getRoles(string $col = 'id', string $sort = 'DESC');
}