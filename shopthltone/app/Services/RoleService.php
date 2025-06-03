<?php
namespace App\Services;

use App\Services\Interfaces\RoleServiceInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface as RoleRepository;
use Illuminate\Support\Facades\DB;

class RoleService implements RoleServiceInterface
{
    protected $roleRepository;
    public function __construct(RoleRepository $roleRepository){
        $this->roleRepository = $roleRepository;
    }
    
    public function create($request){
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token','send']);
            $this->roleRepository->create($payload);
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
        return $this->roleRepository->getData($select, $condition, $counter);
    }
    private function select(){
        return [
            'id',
            'name',
            'slug'
        ];
    }
}