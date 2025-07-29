<?php
namespace App\Services;

use App\Repositories\Interfaces\ModuleRepositoryInterface as ModuleRepository;
use App\Services\Interfaces\ModuleServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\PermissionRepositoryInterface as PermissionRepository;

class ModuleService implements ModuleServiceInterface
{
    protected $moduleRepository;
    protected $permissionRepository;
    public function __construct(ModuleRepository $moduleRepository, PermissionRepository $permissionRepository)
    {
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->moduleRepository = $moduleRepository;
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->permissionRepository = $permissionRepository;
    }

    public function create(Request $request){
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload());
            $module = $this->moduleRepository->create($payload);
            //Tạo permission cho module
            $permission = config('apps.general.permission');
            foreach ($permission as $code => $item) {
                $payloadPermission = [
                    'name' => $item,
                    'canonical' => $payload['code'].'.'.$code,
                    'description' => $item.' for '.$payload['code'],
                    'module_id' => $module->id
                ];
                $this->permissionRepository->create($payloadPermission);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
        
    }
    private function payload(){
        return [
            'id',
            'name',
            'code',
            'description',
            'publish',
        ];
    }
}
