<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionStoreRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\PermissionServiceInterface as PermissionService;
use App\Repositories\Interfaces\PermissionRepositoryInterface as PermissionRepository;
use App\Repositories\Interfaces\RoleRepositoryInterface as RoleRepository;

class PermissionController extends BackendController
{
    protected $permissionService;
    protected $permissionRepository;
    protected $roleRepository;
    public function __construct(PermissionService $permissionService, PermissionRepository $permissionRepository, RoleRepository $roleRepository){
        parent::__construct();
        $this->permissionService = $permissionService;
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
    }
    public function rolePermission(Request $request){
        if($this->permissionService->rolePermission($request)){
            return redirect()->route('user.permission')->with('success', __('permission.message.rolepermission.success'));
        }
        return redirect()->route('user.permission')->with('error', __('permission.message.rolepermission.error'));
    }
    public function store(PermissionStoreRequest $request){
        if($this->permissionService->create($request)){
            return redirect()->route('user.permission')->with('success', __('permission.message.create.success'));
        }
        return redirect()->route('user.permission')->with('error', __('permission.message.create.error'));
    }
    public function create(){
        $template = 'backend.user.permission.store';
        $method = 'create';
        $heading = __('permission');
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'method'    => $method,
                'heading'   => $heading,
            ]
        );
    }
    public function index(Request $request){
        $template = 'backend.user.permission.index';
        $heading = __('permission');
        $config = $this->config();
        $data = $this->permissionRepository->all();
        $roles = $this->roleRepository->getRoles();
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'heading'   => $heading,
                'config'    => $config,
                'data'      => $data,
                'roles'     => $roles,
            ]
        );
    }
    private function config(){
        return [
            'css' => [
                $this->asset.'/css/plugins/iCheck/custom.css',
            ],
            'script' => [
                $this->asset.'/js/plugins/iCheck/icheck.min.js',
                $this->asset.'/js/icheckCustom.js',
            ]
        ];
    }
}
