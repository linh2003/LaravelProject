<?php
namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivationMail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;

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
    public function update($id, Request $request){
        DB::beginTransaction();
        try {
            $payload = $this->formatPayload($request);
            // dd($payload);
            $this->userRepository->update($id, $payload);
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
            $password = $payload['password'];
            // dd($payload);
            $payload['password'] = Hash::make($payload['password']);
            // dd($payload);
            $user = $this->userRepository->create($payload);
            DB::commit();
            //Send email
            if($user){
                $email = $payload['email'];
                $data = [
                    'email' => $email,
                    'password' => $password,
                    'url' => URL::to('/').'/admin'
                ];
                Mail::to($email)->send(new ActivationMail($data));
            }
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
    private function formatPayload($request){
        $payload = $request->only($this->payload());
        $payload['birthday'] = !empty($payload['birthday']) ? Carbon::createFromFormat('d/m/Y', $payload['birthday']) : null;
        $payload['day_of_join'] = !empty($payload['day_of_join']) ? Carbon::createFromFormat('d/m/Y', $payload['day_of_join']) : null;
        $payload['day_of_leave'] = !empty($payload['day_of_leave']) ? Carbon::createFromFormat('d/m/Y', $payload['day_of_leave']) : null;
        $payload['salary'] = convertPrice($payload['salary']);
        $payload['bonus'] = convertPrice($payload['bonus']);
        if (!isset($payload['status'])) {
            $payload['status'] = config('apps.general.unpublish');
        }
        if(isset($payload['social_option'])){
            $social = [];
            foreach ($payload['social_option'] as $k => $item) {
                $social[$item] = $payload['social_path'][$k];
            }
            $payload['social'] = $social;
        }
        // dd($payload);
        return $payload;
    }
    private function payload(){
        return [
            'name',
            'email',
            'password',
            'phone',
            'birthday',
            'image',
            'address',
            'status',
            'cccd',
            'bhxh',
            'province_id',
            'district_id',
            'ward_id',
            'salary',
            'bonus',
            'gender',
            'day_off_number',
            'day_of_join',
            'day_of_leave',
            'social_option',
            'social_path'
        ];
    }
}
