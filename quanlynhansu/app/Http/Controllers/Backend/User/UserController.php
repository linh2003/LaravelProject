<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\RoleRepositoryInterface as RoleRepository;
use App\Http\Requests\User\UserStoreRequest;

class UserController extends BackendController
{
    protected $userService;
    protected $userRepository;
    protected $roleRepository;
    protected $asset;
    public function __construct(UserService $userService, UserRepository $userRepository, RoleRepository $roleRepository){
        parent::__construct();
        $this->userService = $userService;
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->userRepository = $userRepository;
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->roleRepository = $roleRepository;
    }
    public function changeRole(Request $request){
        if($users = $this->userService->changeRole($request)){
            return redirect()->route('user.view')->with('success',__('user.index.changerole.message.success'));
        }
        return redirect()->route('user.view')->with('error',__('user.index.changerole.message.error'));
    }
    public function store(UserStoreRequest $request){
        if($users = $this->userService->create($request)){
            return redirect()->route('user.view')->with('success',__('general.message.create.success'));
        }
        return redirect()->route('user.view')->with('error',__('general.message.create.error'));
    }
    
    public function create(){
        $this->authorize('modules', 'user.create');
        $template = 'main.users.user.store';
        $config = $this->config();
        $config['js'][] = $this->asset.'/plugins/ckfinder_2/ckfinder.js';
        $config['js'][] = $this->asset.'/js/libraries/finder.js';
            
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config
            ]
        );
    }

    public function index(Request $request){
        $template = 'main.users.user.index';
        $users = $this->userRepository->getAll(['*'],['roles']);
        // dd($users);
        $roles = $this->roleRepository->getAll(['id', 'name']);
        $config = $this->config();
        $config['css'][] = $this->asset.'/css/plugins/dataTables/dataTables.css';
        $config['script'][] = $this->asset.'/js/plugins/dataTables/datatables.js';
        $config['script'][] = $this->asset.'/js/dataTable.js';
        $config['script'][] = $this->asset.'/js/module/user/changeRole.js';
        $heading = __('user');
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config,
                'heading' => $heading,
                'users' => $users,
                'roles' => $roles,
            ]
        );
    }

    private function config(){
        return [
            'css' => [
                $this->asset.'/css/plugins/switchery/switchery.min.css'
            ],
            'script' => [
                $this->asset.'/js/plugins/switchery/switchery.min.js',
                $this->asset.'/js/setupSwitchery.js',
                $this->asset.'/js/checkboxes.js',
                $this->asset.'/js/switchStatus.js'
            ]
        ];
    }
}
