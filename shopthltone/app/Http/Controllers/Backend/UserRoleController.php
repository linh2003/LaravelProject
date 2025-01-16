<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRoleStoreRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserRoleServiceInterface as UserRoleService;
use App\Repositories\Interfaces\UserRoleRepositoryInterface as UserRoleRepository;

class UserRoleController extends Controller
{
    protected $userRoleService;
    protected $userRoleRepository;
    protected $baseUrl;
    public function __construct(UserRoleService $userRoleService, UserRoleRepository $userRoleRepository){
        $this->userRoleService = $userRoleService;
        $this->userRoleRepository = $userRoleRepository;
        $this->baseUrl = asset('backend');
    }

    public function store(UserRoleStoreRequest $req){
        if ($this->userRoleService->create($req)) {
            return redirect()->route('user.role')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('user.role')->with('error','Thêm mới bản ghi thất bại');
    }
    public function create(Request $request){
        $template = 'backend.users.role.store';
        $heading = __('role');
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
        $template = 'backend.users.role.index';
        $roles = $this->userRoleService->getRoles($request);
        $counter = $this->userRoleService->getRoles($request,true);
        $heading = __('role');
        
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'data'      => $roles,
                'counter'   => $counter,
                'heading'   => $heading['index'],
            ]
        );
    }
}
