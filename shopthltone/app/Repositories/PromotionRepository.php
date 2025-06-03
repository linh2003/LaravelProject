<?php
namespace App\Repositories;

use App\Models\Promotion;
use App\Repositories\Interfaces\PromotionRepositoryInterface;
use App\Repositories\BaseRepository;

class PromotionRepository extends BaseRepository implements PromotionRepositoryInterface
{
    public function __construct(Promotion $promotion){
        $this->model = $promotion;
    }
    public function getMaxDiscount($selectRaw = '', $condition = [], $join = [], $groupBy = [], $orderBy = []){
        $query = $this->model->selectRaw($selectRaw);
        foreach ($condition as $key => $it) {
            $query->where($it[0], $it[1], $it[2]);
        }
        foreach ($join as $k => $val) {
            $query->join($val[0], $val[1], $val[2], $val[3]);
        }
        $query->groupBy($groupBy);
        if(count($orderBy)){
            $query->orderBy($orderBy[0], $orderBy[1]);
        }
        return $query->get();
    }
}