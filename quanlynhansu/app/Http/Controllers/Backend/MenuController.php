<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Interfaces\MenuRepositoryInterface as MenuRepository;
use App\Repositories\Interfaces\MenuCatalogueRepositoryInterface as MenuCatRepository;
use App\Repositories\Interfaces\RoleRepositoryInterface as RoleRepository;
use App\Services\Interfaces\MenuServiceInterface as MenuService;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Menu\MenuStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class MenuController extends BackendController
{
    protected $menuRepository;
    protected $menuCatRepository;
    protected $roleRepository;
    protected $menuService;
    public function __construct(MenuService $menuService, MenuRepository $menuRepository, MenuCatRepository $menuCatRepository, RoleRepository $roleRepository){
        parent::__construct();
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->menuRepository = $menuRepository;
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->menuCatRepository = $menuCatRepository;
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->roleRepository = $roleRepository;
        /** @var \App\Services\Interfaces\MenuServiceInterface */
        $this->menuService = $menuService;
    }
    public function store(MenuStoreRequest $request){
        if ($this->menuService->create($request)) {
            return redirect()->route('menu.create')->with('success', __('menu.message.create.success'));
        }
        return redirect()->route('menu.create')->with('error', __('menu.message.create.error'));
    }
    public function create(){
        $template = 'main.menu.store';
        $config = $this->config();
        $menuCat = $this->menuCatRepository->getAll();
        $nestableHtml = $this->menuService->getHierarchy();
        $nestable = $this->menuService->getNestedSetbie();
        $menuRole = $this->menuService->getMenuRole();
        // dd($menuRole);
        $routers = Route::getRoutes();
        $roles = $this->roleRepository->getAll(['id', 'name']);
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config,
                'menuCat' => $menuCat,
                'routers' => $routers,
                'roles' => $roles,
                'nestable' => $nestable,
                'menuRole' => $menuRole,
                'nestableHtml' => $nestableHtml,
            ]
        );
    }
    public function config(){
        return [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
                $this->asset.'/css/libraries/animate.css',
                $this->asset.'/css/icofont.css',
                $this->asset.'/css/plugins/iCheck/custom.css',
                $this->asset.'/css/plugins/nestable/nestable.css',
            ],
            'script' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                $this->asset.'/js/libraries/bootstrap-growl.min.js',
                $this->asset.'/js/plugins/accordion/accordion.js',
                $this->asset.'/js/plugins/nestable/jquery.nestable.js',
                $this->asset.'/js/setupSelect2.js',
                $this->asset.'/js/menu.js',
                $this->asset.'/js/setupNestable.js',
            ]
        ];
    }
}
