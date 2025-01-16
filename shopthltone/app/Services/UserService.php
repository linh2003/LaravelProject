<?php
namespace App\Services;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\UserRoleRepositoryInterface as RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    protected $userRepository;
    protected $roleRepository;
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository){
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }
    public function applyRole(Request $post){
        DB::beginTransaction();
        try {
            $payload = $post->except(['_token','send']);
            $ids = explode(',',$payload['uids']);
            $role['role'] = $payload['changerole'];
            // dd($payload);
            $this->userRepository->updateByWhereIn('id',$ids,$role);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function countUserByRole()
    {
        $counter = [];
        $roles = $this->roleRepository->getAll();
        foreach ($roles as $k => $r) {
            $c = $this->userRepository->getCountByCondition(['role'=>$r->id],'=');
            $counter[$r->id] = $c;
        }
        // dd($counter);
        return $counter;
    }
    public function changeStatusAll($post=[]){
        DB::beginTransaction();
        try {
            $payload[$post['field']] = $post['val'];
            $ids = $post['modelId'];
            $flag = $this->userRepository->updateByWhereIn('id',$ids,$payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function changeStatus($post=[]){
        DB::beginTransaction();
        try {
            $payload[$post['field']] = ($post['val']=='1')?'2':'1';
            // dd($payload);
            $id = $post['modelId'];
            $user = $this->userRepository->update($id,$payload);
            // dd($user);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function getUsers($request,$count=false){
        $condition['keyword'] = addslashes($request->input('admin_user_keyword'));
        if($request->integer('publish')){
            $condition['publish'] = $request->integer('publish');
        }
        // dd($condition);
        $perPage = $request->integer('perpage');
        if(!$request->integer('perpage')){
            $perPage = 20;
        }
        $condition['role'] = $request['role'];
        $users = $this->userRepository->getUsers(
            '*',
            $condition,
            [],
            $perPage,
            ['path'=>'admin/user/user'],
            [],
            [],
            $count
        );
        return $users;
    }
    public function create(Request $request){
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token','confirm_pass','send']);
            $carbonDate = Carbon::createFromFormat('Y-m-d',$payload['birthday']);
            $payload['birthday'] = $carbonDate->format('Y-m-d H:i:s');
            $payload['password'] = Hash::make($payload['pass']);
            // dd($payload);
            $user = $this->userRepository->create($payload);
            if($user->id){
                $user->roles()->sync($payload['role']);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function update($id,Request $req){
        // dd($req);
        DB::beginTransaction();
        try {
            $payload = $req->except(['_token','send']);
            // dd($payload);
            if($payload['birthday'] != null){
                $carbonDate = Carbon::createFromFormat('Y-m-d',$payload['birthday']);
                $payload['birthday'] = $carbonDate->format('Y-m-d H:i:s');
            }
            // dd($payload);
            $flag = $this->userRepository->update($id,$payload);
            if ($flag) {
                $user = $this->userRepository->findByID($id);
                $role = $payload['role'];
                // dd($payload);
                $user->roles()->sync($role);
            }
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
            $user = $this->userRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
}
