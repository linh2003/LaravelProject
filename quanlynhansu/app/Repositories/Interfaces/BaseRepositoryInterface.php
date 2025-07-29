<?php
namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function delete($condition = []);
    public function updateWhereIn($column, $value, $payload);
    public function updateCondition($condition, $payload);
    public function update($id, $payload);
    public function getAll($select = ['*'], $relation = [], $orderBy = ['id', 'DESC']);
    public function syncData($model, $relation, $payload);
    public function createPivot($model, $relation, $payload);
    public function create($payload);
    public function getData(
        $columns = ['*'],
        $relation = [],
        $pagination=0,
        $orderBy = ['id', 'DESC']
    );
    public function findByCondition($select = ['*'], $condition = []);
    public function findById($id, $select=['*'], $relation = []);
}