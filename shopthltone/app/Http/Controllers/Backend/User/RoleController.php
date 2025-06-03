<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\RoleServiceInterface as RoleService;

class RoleController extends BackendController
{
    protected $roleService;
    public function __construct(RoleService $roleService){
        $this->roleService = $roleService;
    }
    public function store(RoleStoreRequest $request){
        if ($this->roleService->create($request)) {
            return redirect()->route('user.role')->with('success', __('role.message.create.success'));
        }
        return redirect()->route('user.role')->with('error', __('role.message.create.error'));
    }
    public function create(){
        $template = 'backend.user.role.store';
        $heading = __('role');
        $method = 'create';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'heading'   => $heading,
                'method'    => $method,
            ]
        );
    }
    public function index(Request $request ){
        $template = 'backend.user.role.index';
        $heading = __('role');
        $data = $this->roleService->getData($request);
        $counter = $this->roleService->getData($request, true);
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'heading'   => $heading,
                'data'      => $data,
                'counter'   => $counter,
            ]
        );
    }
}
