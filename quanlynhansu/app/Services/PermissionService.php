<?php
namespace App\Services;

use App\Services\Interfaces\PermissionServiceInterface;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\PermissionRepositoryInterface as PermissionRepository;
use App\Repositories\Interfaces\ModuleRepositoryInterface as ModuleRepository;
use App\Repositories\Interfaces\RoleRepositoryInterface as RoleRepository;
use Illuminate\Support\Str;
use App\Enums\Constant;

class PermissionService extends BaseService implements PermissionServiceInterface
{
    protected $permissionRepository;
    protected $moduleRepository;
    protected $roleRepository;
    public function __construct(PermissionRepository $permissionRepository, ModuleRepository $moduleRepository, RoleRepository $roleRepository)
    {
        parent::__construct();
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->permissionRepository = $permissionRepository;
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->moduleRepository = $moduleRepository;
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->roleRepository = $roleRepository;
    }
    public function rolePermission(Request $request){
        DB::beginTransaction();
        try {
            $payload = $request->input('permission');
            // dd($payload);
            foreach ($payload as $key => $item) {
                $role = $this->roleRepository->findById($key);
                $this->permissionRepository->syncData($role, 'permissions', $item);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function update($id, Request $request){
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload());
            $this->permissionRepository->update($id, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }

    public function create(Request $request){
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload());
            $this->permissionRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function getPermissionGroupModule(){
        return $this->moduleRepository->getAll(['id', 'name'], ['permissions']);
    }
    private function payload(){
        return [
            'name',
            'canonical',
            'description'
        ];
    }
}
