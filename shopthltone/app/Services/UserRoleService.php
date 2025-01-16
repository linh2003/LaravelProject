<?php
namespace App\Services;
use App\Services\Interfaces\UserRoleServiceInterface;
use App\Repositories\Interfaces\UserRoleRepositoryInterface as UserRoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserRoleService implements UserRoleServiceInterface
{
    protected $userRoleRepository;
    public function __construct(UserRoleRepository $userRoleRepository){
        $this->userRoleRepository = $userRoleRepository;
    }
    
    public function getRoles($request, $count=false){
        $condition['keyword'] = addslashes($request->input('user_role_keyword'));
        // dd($condition);
        $perPage = $request->integer('perpage');
        if(!$request->integer('perpage')){
            $perPage = 20;
        }
        $roles = $this->userRoleRepository->getDataPagination(
            '*',
            $condition,
            [],
            $perPage,
            ['path'=>'admin/user/role'],
            [],
            [],
            $count
        );
        return $roles;
    }
    public function create(Request $request){
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token','send']);
            // dd($payload);
            $role = $this->userRoleRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function update($id,Request $req){
        DB::beginTransaction();
        try {
            $payload = $req->except(['_token','send']);
            dd($payload);
            $user = $this->userRoleRepository->update($id,$payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function destroy($id){
        DB::beginTransaction();
        try {
            $user = $this->userRoleRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
}
