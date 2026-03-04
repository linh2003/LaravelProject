<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Constants\Number;
use App\Enums\Role;
use App\Services\Interfaces\LicenseServiceInterface as LicenseService;
use App\Services\Interfaces\FieldServiceInterface as FieldService;
use App\Repositories\Interfaces\ModuleRepositoryInterface as ModuleRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Http\Requests\Module\License\LicenseStoreRequest;

class LicenseController extends BackendController
{
	protected $licenseService;
    protected $fieldService;
    protected $moduleRepository;
    protected $userRepository;
    public function __construct(LicenseService $licenseService, FieldService $fieldService, ModuleRepository $moduleRepository, UserRepository $userRepository){
		parent::__construct();
		$this->licenseService = $licenseService;
        $this->fieldService = $fieldService;
        $this->moduleRepository = $moduleRepository;
        $this->userRepository = $userRepository;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(LicenseStoreRequest $request)
    {
        if ($this->licenseService->create($request)) {
            return redirect()->route('license.view')->with('success', __('general.message.create.success'));
        }
        return redirect()->route('license.view')->with('error', __('general.message.create.error'));
    }
    public function create(){
        $template = 'main.license.store';
        $method = 'create';
		$config = $this->config();
		$currentUser = Auth::user();
        //get approver
        $approver = $this->userRepository->findByCondition(
            ['id', 'name'],
            [
                'where' => [['tb1.role_id', '=', Role::KE_TOAN]]
            ],
            [
                ['user_role as tb1', 'users.id', '=', 'tb1.user_id']
            ],
            true
        );
        //Lấy các field của module
        $fields = $this->getFields();
        // dd($fields);
        return view(
            'main.layout', 
            [
                'template' => $template,
                'method' => $method,
				'config' => $config,
				'currentUser' => $currentUser,
                'approver' => $approver,
                'fields' => $fields,
            ]
        );
    }
    public function index(Request $request){
        $template = 'main.license.list';
        $config = $this->config();
        $licenses = $this->licenseService->getData($request);
        $counter = $this->licenseService->getData($request, true);
        $users = $this->userRepository->getAll();
        //Lấy các field của module
        $fields = $this->getFields();
        // dd($fields);
		return view(
            'main.layout', 
            [
                'template' => $template,
                'config' => $config,
                'licenses' => $licenses,
                'users' => $users,
                'fields' => $fields,
                'counter' => $counter,
            ]
        );
    }
    private function getFields(){
        //Lấy các field của module
        $condition = [
            'where' => [
                ['code', '=', 'license'],
                ['publish', '=', Number::PUBLISH]
            ]
        ];
        $module = $this->moduleRepository->findByCondition('id', $condition, [], true);
        $fields = $module ? $this->fieldService->getFieldForModule($module->id) : [];
        return $fields;
    }
	private function config(){
        return [
            'css' => [
				'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
				$this->asset.'/css/plugins/datapicker/datepicker3.css',
            ],
            'script' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                $this->asset.'/js/setupSelect2.js',
                $this->asset.'/js/setupDatePicker.js',
				$this->asset.'/js/plugins/datapicker/bootstrap-datepicker.js',
                $this->asset.'/js/module/license.js',
            ]
        ];
    }
}
