<?php
namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function getAll($orderBy=['id','DESC'],$relation=[]);
    public function getDataPagination(
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
    public function createBatch($payload=[]);
    public function create($payload=[]);
    public function createPivot($model,$payload=[],$relation='');
    public function updateByWhere($condition=[],$payload=[]);
    public function update($id,$payload);
    public function updateByWhereIn($whereInField, $whereIn=[], $payload=[]);
    public function delete($id);
    public function forceDelete($id=0);
    public function forceDeleteByCondition($condition=[]);
    public function findByID(
        int $id,
        $column=['*'],
        $relation=[]
    );
    
}