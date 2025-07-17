<?php
namespace App\Services;

use App\Services\Interfaces\MenuServiceInterface;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\MenuRepositoryInterface as MenuRepository;
use App\Repositories\Interfaces\MenuCatalogueRepositoryInterface as MenuCatRepository;
use Illuminate\Support\Str;
use App\Enums\Constant;
use App\Classes\Nestedsetbie;

class MenuService extends BaseService implements MenuServiceInterface
{
    protected $menuRepository;
    protected $menuCatRepository;
    protected $nestedsetbie;
    public function __construct(MenuRepository $menuRepository, MenuCatRepository $menuCatRepository)
    {
        parent::__construct();
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->menuRepository = $menuRepository;
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->menuCatRepository = $menuCatRepository;
        $this->nestedsetbie = new Nestedsetbie([
            'isMenu' => true,
            'foreignkey' => 'menu_id',
            'table' => 'menus',
            'language_id' => $this->language
        ]);
    }

    public function create(Request $request){
        DB::beginTransaction();
        try {
            $this->menuRepository->delete();
            $payload = $request->except(['_token']);
            // dd($payload);
            $this->menuCatRepository->update(Constant::MAIN_MENU, ['nestable' => $payload['menu_nestable']]);
            $nestable = json_decode($payload['menu_nestable']);
            foreach ($nestable as $k => $it) {
                $this->setHierarchy($it, $payload);
            }
            // dd(123);
            $this->setNestedSetbie();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function getMenuRole(){
        $menu = [];
        $menuRole = $this->menuRepository->getAll(['id'], 'roles');
        foreach ($menuRole as $k => $it) {
            foreach ($it->roles as $key => $item) {
                $menu[$it->id][] = $item->id;
            }
        }
        return $menu;
    }
    public function setupMainNav($user, $roleUser){
        $menus = $this->menuRepository->getMenuWithRole($this->language);
        $menuWithRole = [];
        foreach ($menus as $menu) {
            foreach ($menu->roles as $role) {
                $menuWithRole[$menu->id][] = $role->id;
            }
        }
        return $this->nestedsetbie->setupMainNav($user, $roleUser, $menuWithRole);
    }
    public function getNestedSetbie(){
        $this->nestedsetbie->Get();
        return $this->nestedsetbie->getData();
    }
    public function getHierarchy(){
        return $this->nestedsetbie->getNestable();
    }
    public function setHierarchy($item, $payload, $parentId = 0){
        $payloadFormat = $this->formatPayload($payload, $item, $parentId);
        $parent = $this->menuRepository->create($payloadFormat);
        $parent->languages()->detach($parent->id, $this->language);
        $payloadLanguage = $this->formatPayloadLanguage($payload, $item->id);
        $this->menuRepository->createPivot($parent, 'languages', $payloadLanguage);
        $this->menuRepository->syncData($parent, 'roles', $payload['menu'][$item->id]['role']);
        if (isset($item->children) && count($item->children)) {
            foreach ($item->children as $key => $child) {
                $this->setHierarchy($child, $payload, $parent->id);
            }
        }
    }
    private function formatPayloadLanguage($payload, $id){
        return [
            'name' => $payload['menu'][$id]['name'],
            'canonical' => isset($payload['menu'][$id]['route']) ? $payload['menu'][$id]['route'] : '',
            'language_id' => $this->language
        ];
    }
    private function formatPayload($payload = [], $item, $parentId = 0){
        // dd(Constant::MAIN_MENU);
        return [
            'parent_id' => $parentId,
            'menu_catalogue_id' => Constant::MAIN_MENU,
            'icon' => $payload['menu'][$item->id]['icon'],
            'publish' => config('apps.general.publish'),
            'user_id' => Auth::id()
        ];
    }
    private function setNestedSetbie(){
        $this->nestedsetbie->Get();
        $this->nestedsetbie->Recursive(0, $this->nestedsetbie->Set());
        $this->nestedsetbie->Action();
    }
}
