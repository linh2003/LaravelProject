<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Interfaces\MenuRepositoryInterface as MenuRepository;
use App\Services\Interfaces\MenuServiceInterface as MenuService;
use Illuminate\Support\Facades\Auth;

class NavComposer
{
    protected $menuService;
    public function __construct(MenuService $menuService){
        $this->menuService = $menuService;
    }
    public function compose(View $view){
        $user = Auth::user();
        $roleUser = [];
        foreach ($user->roles as $role) {
            $roleUser[] = $role->id;
        }
        $menus = $this->menuService->setupMainNav($user, $roleUser);
        $view->with([
            'user' => $user,
            'menus' => $menus,
        ]);
    }
}
