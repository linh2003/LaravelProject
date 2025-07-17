<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\User\Role\RoleStoreRequest;
use App\Http\Requests\User\Role\RoleUpdateRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\RoleServiceInterface as RoleService;
use App\Repositories\Interfaces\RoleRepositoryInterface as RoleRepository;

class RoleController extends BackendController
{
    protected $roleService;
    protected $roleRepository;
    public function __construct(RoleService $roleService, RoleRepository $roleRepository){
        parent::__construct();
        /** @var \App\Services\Interfaces\RoleServiceInterface */
        $this->roleService = $roleService;
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->roleRepository = $roleRepository;
    }
    public function update($id, RoleUpdateRequest $request){
        if ($this->roleService->update($id, $request)) {
            return redirect()->route('role.view')->with('success', __('general.message.update.success'));
        }
        return redirect()->route('role.view')->with('error', __('general.message.update.error'));
    }
    public function edit($id){
        $template = 'main.users.role.store';
        $role = $this->roleRepository->findById($id);
        $method = 'edit';
        $config = $this->config();
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config,
                'method' => $method,
                'role' => $role,
            ]
        );
    }
    public function store(RoleStoreRequest $request){
        if ($this->roleService->create($request)) {
            return redirect()->route('role.view')->with('success', __('general.message.create.success'));
        }
        return redirect()->route('role.view')->with('error', __('general.message.create.error'));
    }
    public function create(){
        $template = 'main.users.role.store';
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
        $template = 'main.users.role.index';
        $roles = $this->roleRepository->getAll(['id', 'name'], 'users');
        $config = $this->config();
        $config['css'][] = $this->asset.'/css/plugins/dataTables/dataTables.css';
        $config['script'][] = $this->asset.'/js/plugins/dataTables/datatables.js';
        $config['script'][] = $this->asset.'/js/dataTable.js';
        $config['script'][] = $this->asset.'/js/checkboxes.js';
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config,
                'roles' => $roles,
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
