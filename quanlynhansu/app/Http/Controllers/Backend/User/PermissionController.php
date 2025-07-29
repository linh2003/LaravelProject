<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Permission\PermissionRequest;
use App\Http\Requests\User\Permission\PermissionUpdateRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\PermissionServiceInterface as PermissionService;
use App\Repositories\Interfaces\PermissionRepositoryInterface as PermissionRepository;
use App\Repositories\Interfaces\RoleRepositoryInterface as RoleRepository;
use App\Enums\Constant;

class PermissionController extends BackendController
{
    protected $permissionService;
    protected $permissionRepository;
    protected $roleRepository;
    public function __construct(PermissionService $permissionService, PermissionRepository $permissionRepository, RoleRepository $roleRepository){
        parent::__construct();
        $this->permissionService = $permissionService;
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->permissionRepository = $permissionRepository;
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->roleRepository = $roleRepository;
    }
    public function rolePermission(Request $request){
        if ($this->permissionService->rolePermission($request)) {
            return redirect()->route('permission.view')->with('success', __('general.message.update.success'));
        }
        return redirect()->route('permission.view')->with('error', __('general.message.update.error'));
    }
    public function update($id, PermissionUpdateRequest $request){
        if ($this->permissionService->update($id, $request)) {
            return redirect()->route('role.view')->with('success', __('general.message.update.success'));
        }
        return redirect()->route('role.view')->with('error', __('general.message.update.error'));
    }
    public function edit($id){
        $template = 'main.users.permission.store';
        $method = 'edit';
        $permission = $this->permissionRepository->findById($id);
        $config = $this->config();
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config,
                'method' => $method,
                'permission' => $permission,
            ]
        );
    }
    public function store(PermissionRequest $request){
        if ($this->permissionService->create($request)) {
            return redirect()->route('permission.view')->with('success', __('general.message.create.success'));
        }
        return redirect()->route('permission.view')->with('error', __('general.message.create.error'));
    }
    public function create(){
        $template = 'main.users.permission.store';
        $method = 'create';
        $config = $this->config();
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config,
                'method' => $method,
            ]
        );
    }
    public function index(){
        $this->authorize('modules', 'user.edit.any');
        $template = 'main.users.permission.index';
        $config = $this->config();
        $permissions = $this->permissionService->getPermissionGroupModule();
        $roles = $this->roleRepository->getAll(['id', 'name']);
        $config['css'][] = $this->asset.'/css/plugins/dataTables/dataTables.css';
        $config['script'][] = $this->asset.'/js/plugins/dataTables/datatables.js';
        $config['script'][] = $this->asset.'/js/dataTable.js';
        $config['script'][] = $this->asset.'/js/checkboxes.js';
        $config['permissionModule'] = config('apps.general.permissionModule');
        $config['quantrirole'] = Constant::QUANTRIROLE;
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config,
                'roles' => $roles,
                'permissions' => $permissions,
            ]
        );
    }
    private function config(){
        return [
            'css' => [
                
            ],
            'script' => [
                $this->asset.'/js/autoMachineName.js',
            ]
        ];
    }
}
