<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\UserRoleRepositoryInterface as UserRoleRepository;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    protected $userService;
    protected $userRepository;
    protected $userRoleRepository;
    protected $baseUrl;
    public function __construct(UserService $userService, UserRepository $userRepository, UserRoleRepository $userRoleRepository){
        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->userRoleRepository = $userRoleRepository;
        $this->baseUrl = asset('backend');
    }
    public function index(Request $request){
        $template = 'backend.users.index';
        $users = $this->userService->getUsers($request);
        $counter = $this->userService->getUsers($request,true);
        // dd($counter);
        $config = $this->config();
        
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'data'      => $users,
                'counter'   => $counter,
                'css'       => $config['css'],
                'scripts'    => $config['js'],
            ]
        );
    }
    public function store(UserStoreRequest $userStoreRequest){
        if ($this->userService->create($userStoreRequest)) {
            return redirect()->route('admin.user')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('admin.user')->with('error','Thêm mới bản ghi thất bại');
    }
    public function create(Request $request){
        $template = 'backend.users.store';
        $config['css'] = [
            $this->baseUrl.'/css/plugins/select2/select2.min.css'
        ];
        $config['js'] = [
            $this->baseUrl.'/plugins/ckfinder_2/ckfinder.js',
            $this->baseUrl.'/js/finder.js',
            $this->baseUrl.'/js/plugins/select2/select2.full.min.js',
            $this->baseUrl.'/js/customSelect2.js',
        ];
        $heading = __('user');
        $method = 'create';
        $roles = $this->userRoleRepository->getAll();
        return view(
            'backend.layout',
            [
                'template' => $template,
                'heading' => $heading,
                'method' => $method,
                'roles' => $roles,
                'css' => $config['css'],
                'scripts' => $config['js'],
            ]
        );
    }
    public function update($id,UserUpdateRequest $req){
        if ($this->userService->update($id,$req)) {
            return redirect()->route('admin.user')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('admin.user')->with('error','Cập nhật bản ghi thất bại');
    }
    public function edit($id,Request $request){
        $user = $this->userRepository->findByID($id);
        $template = 'backend.users.store';
        $heading = __('user');
        $method = 'update';
        $roles = $this->userRoleRepository->getAll();
        $config['css'] = [
            $this->baseUrl.'/css/plugins/select2/select2.min.css'
        ];
        $config['js'] = [
            $this->baseUrl.'/plugins/ckfinder_2/ckfinder.js',
            $this->baseUrl.'/js/finder.js',
            $this->baseUrl.'/js/plugins/select2/select2.full.min.js',
            $this->baseUrl.'/js/customSelect2.js',
        ];
        return view(
            'backend.layout',
            [
                'template' => $template,
                'heading' => $heading,
                'method' => $method,
                'user' => $user,
                'roles' => $roles,
                'css' => $config['css'],
                'scripts' => $config['js'],
            ]
        );
    }
    public function changeRole(){
        
    }
    private function config(){
        return [
            'css' => [
                $this->baseUrl.'/css/plugins/switchery/switchery.css',
            ],
            'js' => [
                $this->baseUrl.'/js/plugins/switchery/switchery.js',
                $this->baseUrl.'/js/customSwitchery.js',
                $this->baseUrl.'/js/customCheckboxStatus.js',
            ],
        ];
    }
}
