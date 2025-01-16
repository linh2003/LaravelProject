<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionStoreRequest;
use App\Http\Requests\PermissionUpdateRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\PermissionServiceInterface as PermissionService;
use App\Repositories\Interfaces\PermissionRepositoryInterface as PermissionRepository;
use App\Repositories\Interfaces\UserRoleRepositoryInterface as UserRoleRepository;

class PermissionController extends Controller
{
    protected $permissionService;
    protected $permissionRepository;
    protected $userRoleRepository;
    protected $baseUrl;
    public function __construct(PermissionService $permissionService, PermissionRepository $permissionRepository, UserRoleRepository $userRoleRepository){
        $this->permissionService = $permissionService;
        $this->permissionRepository = $permissionRepository;
        $this->userRoleRepository = $userRoleRepository;
        $this->baseUrl = asset('backend');
    }

    public function rolePermission(Request $request){
        // dd($request->input('permission'));
        if($this->permissionService->setPermission($request)){
            return redirect()->route('user.permission')->with('success','Thay đổi phân quyền thành công');
        }
        return redirect()->route('user.permission')->with('error','Thay đổi phân quyền thất bại. Vui lòng thử lại!');
    }

    public function update($id,PermissionUpdateRequest $req){
        if ($this->permissionService->update($id,$req)) {
            return redirect()->route('user.permission')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('user.permission')->with('error','Cập nhật bản ghi thất bại');
    }

    public function edit($id){
        $permission = $this->permissionRepository->findByID($id);
        $template = 'backend.users.permission.store';
        $heading = __('permission');
        $method = 'update';
        return view(
            'backend.layout',
            [
                'template'      => $template,
                'heading'       => $heading,
                'method'        => $method,
                'permission'    => $permission,
            ]
        );
    }

    public function store(PermissionStoreRequest $req){
        if ($this->permissionService->create($req)) {
            return redirect()->route('user.permission')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('user.permission')->with('error','Thêm mới bản ghi thất bại');
    }

    public function create(Request $request){
        $template = 'backend.users.permission.store';
        $heading = __('permission');
        $method = 'create';
        return view(
            'backend.layout',
            [
                'template' => $template,
                'heading' => $heading,
                'method' => $method,
            ]
        );
    }
    public function index(Request $request){
        $template = 'backend.users.permission.index';
        $permissions = $this->permissionService->getPermissions($request);
        $roles = $this->userRoleRepository->getAll(['id','ASC'],['permissions']);
        $heading = __('permission');
        $config = $this->config();
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'data'      => $permissions,
                'heading'   => $heading['index'],
                'roles'     => $roles,
                'css'       => $config['css'],
                'scripts'   => $config['js'],
            ]
        );
    }
    private function config(){
        return [
            'css' => [
                $this->baseUrl.'/css/plugins/iCheck/custom.css'
            ],
            'js' => [
                $this->baseUrl.'/js/plugins/iCheck/icheck.min.js',
                $this->baseUrl.'/js/icheck.js',
            ]
        ];
    }
}
