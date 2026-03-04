<?php

namespace App\Http\Controllers\Backend\Module;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Module\ModuleStoreRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\ModuleServiceInterface as ModuleService;
use App\Services\Interfaces\FieldServiceInterface as FieldService;
use App\Repositories\Interfaces\ModuleRepositoryInterface as ModuleRepository;
use Illuminate\Support\Facades\Cache;

// use Illuminate\Support\Facades\App;

class ModuleController extends BackendController
{
    protected $moduleService;
    protected $fieldService;
    protected $moduleRepository;
    public function __construct(ModuleService $moduleService, ModuleRepository $moduleRepository, FieldService $fieldService){
		parent::__construct();
        /** @var App\Services\Interfaces\BaseServiceInterface */
        $this->moduleService = $moduleService;
		/** @var App\Services\Interfaces\BaseServiceInterface */
        $this->fieldService = $fieldService;
        /** @var App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->moduleRepository = $moduleRepository;
        // $this->asset = asset('backend');
    }
	
	public function edit($id){
        $template = 'main.module.store';
        $config = $this->config();
        $method = 'update';
		$module = $this->moduleRepository->findById($id);
		$fields = $this->fieldService->getFieldForModule($id);
		dd($fields);
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config,
                'method' => $method,
                'module' => $module,
            ]
        );
    }

    public function store(ModuleStoreRequest $request){
        if($module = $this->moduleService->create($request)){
            return redirect()->route('module.view')->with('success','Insert new module success');
        }
        return redirect()->route('module.view')->with('error','Insert new module fail. Please try again!');
    }
    
    public function create(){
        $template = 'main.module.store';
        $config = $this->config();
        $method = 'create';
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config,
                'method' => $method,
            ]
        );
    }

    public function index(Request $request){
        $template = 'main.module.index';
        $modules = $this->moduleRepository->getAll();
        // dd($modules);
        $config = $this->config();
        $config['css'][] = $this->asset.'/css/plugins/dataTables/dataTables.css';
        $config['script'][] = $this->asset.'/js/plugins/dataTables/datatables.js';
        $config['script'][] = $this->asset.'/js/dataTable.js';
        $config['script'][] = $this->asset.'/js/module/module/field.js';
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config,
                'modules' => $modules,
            ]
        );
    }

    private function config(){
        return [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
                $this->asset.'/css/plugins/switchery/switchery.min.css'
            ],
            'script' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                $this->asset.'/js/setupSelect2.js',
                $this->asset.'/js/plugins/switchery/switchery.min.js',
                $this->asset.'/js/setupSwitchery.js',
                $this->asset.'/js/switchStatus.js',
                $this->asset.'/js/autoMachineName.js',
            ]
        ];
    }
}
