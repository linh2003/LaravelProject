<?php
namespace App\Repositories\Interfaces;

interface MenuRepositoryInterface
{
    public function getMenuWithRole($languageId);
    public function getChilds($id, $select = ['*']);
}