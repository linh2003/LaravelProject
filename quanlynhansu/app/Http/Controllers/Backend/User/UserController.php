<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\RoleRepositoryInterface as RoleRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Http\Requests\User\User\UserStoreRequest;
use App\Http\Requests\User\User\UserUpdateRequest;

class UserController extends BackendController
{
    protected $userService;
    protected $userRepository;
    protected $roleRepository;
    protected $provinceRepository;
    // protected $asset;
    public function __construct(UserService $userService, UserRepository $userRepository, RoleRepository $roleRepository, ProvinceRepository $provinceRepository){
        parent::__construct();
        $this->userService = $userService;
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->userRepository = $userRepository;
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->roleRepository = $roleRepository;
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->provinceRepository = $provinceRepository;
    }
    public function changeRole(Request $request){
        if($users = $this->userService->changeRole($request)){
            return redirect()->route('user.view')->with('success', __('user.index.changerole.message.success'));
        }
        return redirect()->route('user.view')->with('error', __('user.index.changerole.message.error'));
    }
    public function update($id, UserUpdateRequest $request){
        if($this->userService->update($id, $request)){
            return redirect()->route('user.view')->with('success', __('general.message.update.success'));
        }
        return redirect()->route('user.view')->with('error', __('general.message.update.error'));
    }
    public function edit($id){
        if (auth()->id() == $id) {
            $this->authorize('modules', 'user.edit.own');
        }else{
            $this->authorize('modules', 'user.edit.any');
        }
        $user = $this->userRepository->findById($id);
        // dd(json_decode($user->social));
        $template = 'main.users.user.store';
        $config = $this->config();
        $method = 'update';
        $config['script'][] = $this->asset.'/plugins/ckfinder_2/ckfinder.js';
        $config['script'][] = $this->asset.'/js/libraries/finder.js';
        $province = $this->provinceRepository->getAll(['code', 'name'], [], ['code', 'ASC']);
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config,
                'method' => $method,
                'user' => $user,
                'province' => $province,
            ]
        );
    }
    public function store(UserStoreRequest $request){
        if($users = $this->userService->create($request)){
            return redirect()->route('user.view')->with('success', __('general.message.create.success'));
        }
        return redirect()->route('user.view')->with('error', __('general.message.create.error'));
    }
    
    public function create(){
        $this->authorize('modules', 'user.create');
        $template = 'main.users.user.store';
        $province = $this->provinceRepository->getAll(['code', 'name'], [], ['code', 'ASC']);
        $method = 'create';
        $config = $this->config();
        $config['css'][] = $this->asset.'/auth/css/dashicons.min.css';
        $config['css'][] = $this->asset.'/auth/css/custom.css';
        $config['script'][] = $this->asset.'/plugins/ckfinder_2/ckfinder.js';
        $config['script'][] = $this->asset.'/js/libraries/finder.js';
        $config['script'][] = $this->asset.'/js/libraries/hooks.min.js';
        $config['script'][] = $this->asset.'/js/libraries/i18n.min.js';
        $config['script'][] = $this->asset.'/js/libraries/user-profile.min.js';
            
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config,
                'method' => $method,
                'province' => $province,
            ]
        );
    }

    public function index(Request $request){
        $this->authorize('modules', 'user.view.any');
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
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
                $this->asset.'/css/plugins/switchery/switchery.min.css',
                $this->asset.'/css/plugins/datapicker/datepicker3.css',
            ],
            'script' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                $this->asset.'/js/setupSelect2.js',
                $this->asset.'/js/plugins/switchery/switchery.min.js',
                $this->asset.'/js/plugins/datapicker/bootstrap-datepicker.js',
                $this->asset.'/js/location.js',
                $this->asset.'/js/price.js',
                $this->asset.'/js/setupSwitchery.js',
                $this->asset.'/js/checkboxes.js',
                $this->asset.'/js/switchStatus.js',
                $this->asset.'/js/module/user/user.js',
            ]
        ];
    }
}
