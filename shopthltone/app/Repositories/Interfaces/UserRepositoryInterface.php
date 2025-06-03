<?php
namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getUser(
        $select = ['*'],
        $condition = [],
        $counter = false,
        $join = [],
        $orderBy = ['id', 'DESC'],
        $paginate = 20
    );
}