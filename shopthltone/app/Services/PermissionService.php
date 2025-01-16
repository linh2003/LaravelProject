<?php
namespace App\Services;
use App\Services\Interfaces\PermissionServiceInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface as PermissionRepository;
use App\Repositories\Interfaces\UserRoleRepositoryInterface as UserRoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PermissionService implements PermissionServiceInterface
{
    protected $permissionRepository;
    protected $userRoleRepository;
    public function __construct(PermissionRepository $permissionRepository, UserRoleRepository $userRoleRepository){
        $this->permissionRepository = $permissionRepository;
        $this->userRoleRepository = $userRoleRepository;
    }

    public function setPermission(Request $request){
        DB::beginTransaction();
        try {
            $permissions = $request->input('permission');
            foreach ($permissions as $key => $per) {
                // dd($key);
                $role = $this->userRoleRepository->findByID($key);
                $role->permissions()->detach();
                $role->permissions()->sync($per);
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
            $payload = $request->except(['_token','send']);
            $permission = $this->permissionRepository->update($id,$payload);
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
            $payload = $request->except(['_token','send']);
            // dd($payload);
            $permission = $this->permissionRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function getPermissions(Request $request, $count=false,$select=['*']){
        $condition = $request->except('search');
        if (isset($condition['keyword'])) {
            $condition['keyword'] = addslashes($condition['keyword']);
        }
        $perPage = isset($condition['perpage']) ? intval($condition['perpage']) : 0;
        return $this->permissionRepository->getDataPagination($select,$condition,[],$perPage,['path'=>'admin/permission'],[],[],$count,['id','ASC']);
    }
    private function select(){
        return [
            'name',
            'caninocal',
            'image',
            'user_id',
        ];
    }
    
}