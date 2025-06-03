<?php
namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function deleteCondition($condition = []);
    public function syncData($model, $payload=[], $relation='');
    public function destroyCondition($select, $condition, $join);
    public function destroy($id);
    public function remove($id);
    public function upsertData($payload, $unique, $update);
    public function createBatch($payload);
    public function createMany($model, $payload, $relation);
    public function createPivot($model, $payload=[], $relation='');
    public function create($payload = []);
    public function updateByCondition(array $condition = [], array $payload = []);
    public function update($id, $payload = []);
    public function updateWhereIn(string $whereInField, array $whereIn = [], array $condition = []);
    public function findById($id = '', $column = [], $relation = []);
    public function findByCondition(array $select = ['*'], array $condition = [], array $join = [], $groupBy = []);
    public function all(array $select = ['*'], array $sort = ['id', 'DESC']);
    public function getData(
        array $select = [], 
        array $condition = [], 
        $counter = false, 
        array $join = [], 
        string $extern = '', 
        array $rawQuery = [],
        array $relations = [],
        array $orderBy = ['id', 'DESC'], 
        array $groupBy = [],
        $paginate = 20
    );
}