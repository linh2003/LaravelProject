<?php
namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserService extends BaseService implements UserServiceInterface
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->userRepository = $userRepository;
    }
    public function changeRole(Request $request){
        DB::beginTransaction();
        try {
            $payload = $request->except('_token');
            $ids = explode(',', $payload['user_ids']);
            $roleId = $payload['user_role'];
            foreach ($ids as $id) {
                $user = $this->userRepository->findById($id);
                $this->userRepository->syncData($user, 'roles', $roleId);
            }
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
            $payload = $request->except(['_token']);
            $payload['user_id'] = Auth::id();
            $this->userRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
        
    }
    public function getUsers(Request $request){
        $columns = $this->selectColumn();
        $pagination = config('apps.user');
        $users = $this->userRepository->getDataPagination(
            $columns,
            ['roles'],
            $pagination['pagination'][0]
        );
        return $users;
    }
    private function selectColumn(){
        return [
            'id',
            'name',
            'email',
            'phone',
            'birthday',
            'image',
            'address',
            'status',
        ];
    }
}
