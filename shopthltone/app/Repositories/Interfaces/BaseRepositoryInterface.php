<?php
namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function getAll();
    public function getDataPagination(
        $column=['*'],
        $condition=[],
        $join=[],
        $perPage=20,
        $extend=[],
        $relations=[],
        $rawQuery=[],
        $pagination=true,
        $orderBy=['id','DESC']
    );
    public function create($payload=[]);
    public function update($id,$payload=[]);
    public function updateByWhereIn(string $whereInField='',array $whereIn=[],array $payload=[]);

    public function delete($id);

    public function findByID(
        int $id,
        $column=['*'],
        $relation=[]
    );
    public function getCountByCondition($condition=[],$operator='=',$join=[]);
    public function createPivot($model,$payload=[],$relation='');
}