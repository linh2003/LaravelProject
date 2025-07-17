<?php
namespace App\Services;

use App\Services\Interfaces\RoleServiceInterface;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\RoleRepositoryInterface as RoleRepository;
use Illuminate\Support\Str;
use App\Enums\Constant;

class RoleService extends BaseService implements RoleServiceInterface
{
    protected $roleRepository;
    public function __construct(RoleRepository $roleRepository)
    {
        parent::__construct();
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->roleRepository = $roleRepository;
    }
    public function update($id, Request $request){
        DB::beginTransaction();
        try {
            $payload = $this->formatPayload($request);
            $this->roleRepository->update($id, $payload);
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
            $payload = $this->formatPayload($request);
            $this->roleRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    private function formatPayload($request){
        $payload = $request->only($this->payload());
        return [
            'name' => $payload['name'],
            'machine_name' => $payload['code'],
            'description' => $payload['description']
        ];
    }
    private function payload(){
        return [
            'name',
            'code',
            'description'
        ];
    }
}
