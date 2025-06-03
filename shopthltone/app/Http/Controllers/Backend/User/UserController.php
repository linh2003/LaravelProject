<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\ChangeRoleUserRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\RoleRepositoryInterface as RoleRepository;

class UserController extends BackendController
{
    protected $userService;
    protected $userRepository;
    protected $roleRepository;
    public function __construct(UserService $userService, UserRepository $userRepository, RoleRepository $roleRepository){
        parent::__construct();
        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }
    public function changeRole(Request $request){
        $payload = $request->except(['_token', 'save']);
        // dd($payload);
        if(!isset($payload['user_role']) || (isset($payload['user_ids']) && $payload['user_ids'] == null)){
            return redirect()->route('admin.user')->with('error', __('user.message.changerole.error'));
        }
        if($this->userService->changeRoleUser($payload)){
            return redirect()->route('admin.user')->with('success', __('user.message.changerole.success'));
        }
    }
    public function index(Request $request){
        $this->authorize('modules', 'user.view');
        $template = 'backend.user.index';
        $users = $this->userService->getAll($request);
        $counter = $this->userService->getAll($request, true);
        $roles = $this->roleRepository->getRoles();
        // dd($roles);
        $config = $this->config();
        $config['script'][] = $this->asset.'/js/customSwitchery.js';
        $config['script'][] = $this->asset.'/js/checkboxList.js';
        $config['script'][] = $this->asset.'/js/changeRoleUser.js';
        $config['config'] = config('apps.general');
        $heading = __('user');
        $general = __('general');
        return view(
            'backend.layout', 
            [
                'template'  => $template,
                'data'      => $users,
                'counter'   => $counter,
                'roles'     => $roles,
                'config'    => $config,
                'heading'   => $heading,
                'general'   => $general,
            ]
        );
    }
    private function config(){
        return [
            'css' => [
                $this->asset.'/css/plugins/switchery/switchery.css',
                $this->asset.'/css/plugins/iCheck/custom.css',
            ],
            'script' => [
                $this->asset.'/js/plugins/switchery/switchery.js',
                $this->asset.'/js/plugins/iCheck/icheck.min.js',
                $this->asset.'/js/icheckCustom.js',
            ]
        ];
    }
}
