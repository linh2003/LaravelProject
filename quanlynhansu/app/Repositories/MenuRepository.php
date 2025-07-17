<?php
namespace App\Repositories;

use App\Models\Menu;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\MenuRepositoryInterface;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface
{
    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }
    public function getMenuWithRole($languageId){
        $menu = $this->model->select('id')
        ->with('roles')
        ->join('menu_language as tb1', 'menus.id', '=', 'tb1.menu_id')
        ->where('tb1.language_id', '=', $languageId);
        return $menu->get();
    }
    public function getChilds($id, $select = ['*']){
        $query = $this->model->select($select);
        $query->where(function($query) use ($id){
            $query->whereRaw('lft >= (SELECT lft FROM menus WHERE id='.$id.') AND (rgt <= (SELECT rgt FROM menus WHERE id='.$id.'))');
        });
        return $query->get();
    }
}
