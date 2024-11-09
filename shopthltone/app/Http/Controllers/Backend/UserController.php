<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\ApplyRoleRequest;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\UserRoleRepositoryInterface as RoleRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

class UserController extends Controller
{
    protected $userService;
    protected $roleRepository;
    protected $userRepository;
    protected $asset;
    public function __construct(UserService $userService,RoleRepository $roleRepository,UserRepository $userRepository)
    {
        $this->userService = $userService;
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
        $this->asset = asset('backend');
    }
    public function changeRole(Request $request){
        $userIds = $request->input('input');
        // dd($userIds);
        session(['selected_user_ids' => $userIds]);
        return redirect()->route('admin.user.selectrole');
        
    }
    public function selectRole(Request $request){
        $userIds = $request->session()->get('selected_user_ids');
        // dd($userIds);
        $template = 'backend.users.change_user_role';
        $config = $this->config();
        $config['heading'] = config('apps.user');
        $roles = $this->roleRepository->getAll();
        return view('backend.layout',[
            'template'  => $template,
            'css'       => $config['css'],
            'scripts'   => $config['js'],
            'heading'   => $config['heading'],
            'roles'     => $roles,
            'userids'   => $userIds,
        ]);
    }
    public function applyrole(ApplyRoleRequest $req){
        // $post = $req->input();
        if ($this->userService->applyRole($req)) {
            return redirect()->route('admin.user')->with('success','Cập nhật vai trò thành công');
        }
        return redirect()->route('admin.user')->with('error','Cập nhật vai trò thất bại. Hãy thử lại!');
    }
    public function delete($id){
        $user = $this->userRepository->findByID($id);
        $config['heading'] = config('apps.user');
        $template = 'backend.users.delete';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                // 'css'       => $config['css'],
                // 'scripts'   => $config['js'],
                'heading'   => $config['heading'],
                'user'      => $user,
            ]
        );
    }
    public function destroy($id){
        if ($this->userService->destroy($id)) {
            return redirect()->route('admin.user')->with('success','Xóa dữ liệu thành công');
        }
        return redirect()->route('admin.user')->with('error','Xóa dữ liệu thất bại. Hãy thử lại!');
    }
    public function edit($id){
        $user = $this->userRepository->findByID($id);
        // dd($user);
        $config = $this->config();
        $config['heading'] = config('apps.user');
        $config['method'] = 'update';
        $roles = $this->roleRepository->getAll(['DESC','id']);
        $template = 'backend.users.store';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'css'       => $config['css'],
                'scripts'   => $config['js'],
                'heading'   => $config['heading'],
                'method'    => $config['method'],
                'user'      => $user,
                'roles'     => $roles,
            ]
        );
    }
    public function store(UserStoreRequest $userStoreRequest){
        if ($this->userService->create($userStoreRequest)) {
            return redirect()->route('admin.user')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('admin.user')->with('error','Thêm mới bản ghi thất bại');
    }
    public function update($id,UserUpdateRequest $req){
        if ($this->userService->update($id,$req)) {
            return redirect()->route('admin.user')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('admin.user')->with('error','Cập nhật bản ghi thất bại');
    }
    public function create(){
        $config = $config = $this->config();
        $config['heading'] = config('apps.user');
        $config['method'] = 'create';
        $roles = $this->roleRepository->getAll(['DESC','id']);
        $template = 'backend.users.store';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'css'       => $config['css'],
                'scripts'   => $config['js'],
                'heading'   => $config['heading'],
                'method'    => $config['method'],
                'roles'     => $roles,
            ]
        );
    }
    public function index(Request $request){
        $config = $this->config();
        $config['css'][] = $this->asset.'/css/plugins/switchery/switchery.css';
        $config['js'][] = $this->asset.'/js/plugins/switchery/switchery.js';
        $config['js'][] = $this->asset.'/js/customCheckboxStatus.js';
        $config['js'][] = $this->asset.'/js/customSwitchery.js';
        $template = 'backend.users.index';
        // dd($request);
        $users = $this->userService->getUsersPagination($request);
        $roles = $this->roleRepository->getAll();
        $counter = $this->userService->getUsersPagination($request,false);
        // dd($users);
        $config['heading'] = config('apps.user.index');
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'css'       => $config['css'],
                'scripts'   => $config['js'],
                'heading'   => $config['heading'],
                'data'      => $users,
                'roles'     => $roles,
                'counter'   => $counter,
            ]
        );
    }
    private function config(){
        return [
            'css' => [
                $this->asset.'/css/plugins/jasny/jasny-bootstrap.min.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                $this->asset.'/js/customSelect2.js',
            ]
        ];
    }
}
