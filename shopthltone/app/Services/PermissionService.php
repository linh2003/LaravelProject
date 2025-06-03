<?php
namespace App\Services;

use App\Services\Interfaces\PermissionServiceInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface as PermissionRepository;
use App\Repositories\Interfaces\RoleRepositoryInterface as RoleRepository;
use Illuminate\Support\Facades\DB;

class PermissionService implements PermissionServiceInterface
{
    protected $permissionRepository;
    protected $roleRepository;
    public function __construct(PermissionRepository $permissionRepository, RoleRepository $roleRepository){
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
    }
    public function rolePermission($request){
        $permission = $request->input('permission');
        /*
        * permission array:
        * [
        * role_id => [permission_id]
        * ]
         */
        DB::beginTransaction();
        try {
            foreach ($permission as $k => $p) {
                $role = $this->roleRepository->findById($k);
                $this->permissionRepository->syncData($role, $p, 'permissions');
                DB::commit();
            }
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage(); die();
            return false;
        }
    }
    
    public function create($request){
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token','send']);
            $this->permissionRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function getData($request, $counter = false){
        $select = $this->select();
        $condition = $request->except('search');
        return $this->permissionRepository->getAll($select, $condition, $counter);
    }
    private function select(){
        return [
            'id',
            'name',
            'canonical'
        ];
    }
}