<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Menu\MenuCatalogueStoreRequest;
use App\Services\Interfaces\MenuCatalogueServiceInterface as MenuCatalogueService;
use App\Repositories\Interfaces\MenuRepositoryInterface as MenuRepository;

class MenuController extends Controller
{
    protected $menuCatServices;
    protected $menuRepository;
    public function __construct(MenuCatalogueService $menuCatService, MenuRepository $menuRepository){
        /** @var \App\Services\Interfaces\MenuCatalogueServiceInterface */
        $this->menuCatServices = $menuCatService;
        
        $this->menuRepository = $menuRepository;
    }
    public function getChilds(Request $req){
        $id = $req->input('id');
        $childs = $this->menuRepository->getChilds($id, ['id']);
        return response()->json([
            'code' => true,
            'childs' => $childs
        ]);
    }
    public function menuPositionCreate(MenuCatalogueStoreRequest $req){
        $menuCat = $this->menuCatServices->create($req);
        if ($menuCat != false) {
            return response()->json([
                'code' => true,
                'message' => 'Thêm mới vị trí menu thành công',
                'menuCat' => $menuCat
            ]);
        }
        return response()->json([
            'code' => false,
            'message' => 'Thêm mới dữ liệu thất bại. Vui lòng thử lại!'
        ]);
    }
}
