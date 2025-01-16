<?php
namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getUsers(
        $column=['*'],
        $condition=[],
        $join=[],
        $perPage=0,
        $extern=[],
        $relation=[],
        $rawQuery=[],
        $count=false,
        $orderBy=['id','DESC']
    );
    
}