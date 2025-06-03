<?php
namespace App\Services;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\DB;

class UserService implements UserServiceInterface
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }
    public function changeRoleUser($payload){
        $user_ids = json_decode($payload['user_ids'], true);
        $role_ids = $payload['user_role'];
        
        DB::beginTransaction();
        try {
            foreach ($user_ids as $id) {
                $user = $this->userRepository->findById($id);
                $this->userRepository->syncData($user, $role_ids, 'roles');
                DB::commit();
            }
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage(); die();
            return false;
        }
    }
    public function changeStatusAll($request){
        $ids = $request['modelId'];
        $condition = [$request['field'] => $request['value']];
        return $this->userRepository->updateWhereIn('id', $ids, $condition);
    }
    public function getAll($request, $counter = false){
        $keyword = addslashes($request->input('admin_user_keyword'));
        $perpage = $request->input('perpage');
        $publish = intval($request->input('publish'));
        $condition = [
            'keyword' => $keyword,
            'perpage' => $perpage,
            'publish' => $publish,
        ];
        $select = $this->select();
        $users = $this->userRepository->getUser($select, $condition, $counter);
        return $users;
    }
    public function changeStatus($request){
        DB::beginTransaction();
        try {
            $id = $request['modelId'];
            $field = $request['field'];
            $value = ($request['value'] == 1) ? config('apps.general.unpublish') : config('apps.general.publish');
            // dd($value);
            $condition = [$field => $value];
            $this->userRepository->update($id, $condition);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    private function select(){
        return [
            'id',
            'name',
            'email',
            'phone',
            'address',
            'status',
        ];
    }
}