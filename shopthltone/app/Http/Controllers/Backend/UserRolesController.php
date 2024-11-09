<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RoleStoreRequest;
use App\Services\Interfaces\UserRoleServiceInterface as UserRoleService;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\UserRoleRepositoryInterface as UserRoleRepository;

class UserRolesController extends Controller
{
    protected $roleService;
    protected $roleRepository;
    protected $userService;
    public function __construct(UserRoleService $roleService,UserService $userService,UserRoleRepository $roleRepository)
    {
        $this->roleService = $roleService;
        $this->roleRepository = $roleRepository;
        $this->userService = $userService;
    }
    public function destroy($id){
        if ($this->roleService->destroy($id)) {
            return redirect()->route('user.roles')->with('success','Xóa dữ liệu thành công');
        }
        return redirect()->route('user.roles')->with('error','Xóa dữ liệu thất bại. Hãy thử lại!');
    }
    public function delete($id)
    {
        $role = $this->roleRepository->findByID($id);
        $config['heading'] = config('apps.role');
        $template = 'backend.users.role.delete';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'heading'   => $config['heading'],
                'role'      => $role,
            ]
        );
    }
    public function update($id,RoleStoreRequest $req)
    {
        if ($this->roleService->update($id,$req)) {
            return redirect()->route('user.roles')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('user.roles')->with('error','Thêm mới bản ghi thất bại. Hãy thử lại!');
    }
    public function store(RoleStoreRequest $req)
    {
        if ($this->roleService->create($req)) {
            return redirect()->route('user.roles')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('user.roles')->with('error','Thêm mới bản ghi thất bại. Hãy thử lại!');
    }
    public function edit($id)
    {
        $role = $this->roleRepository->findByID($id);
        $config['heading'] = config('apps.role');
        $config['method'] = 'update';
        $template = 'backend.users.role.store';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'heading'   => $config['heading'],
                'method'    => $config['method'],
                'role'      => $role,
            ]
        );
    }
    public function create(){
        $template = 'backend.users.role.store';
        $config['heading'] = config('apps.role');
        $config['method'] = 'create';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'heading'   => $config['heading'],
                'method'    => $config['method'],
                // 'data'      => $roles,
            ]
        );
    }
    public function index(Request $request){
        $template = 'backend.users.role.index';
        $config['heading'] = config('apps.role.index');
        $roles = $this->roleService->getRolePagination($request);
        $counter = $this->userService->countUserByRole();
        // dd($counter);
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'heading'   => $config['heading'],
                'data'      => $roles,
                'counter'   => $counter,
            ]
        );
    }
}
