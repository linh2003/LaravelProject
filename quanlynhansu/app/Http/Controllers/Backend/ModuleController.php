<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\Module\ModuleStoreRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\ModuleServiceInterface as ModuleService;
use App\Repositories\Interfaces\ModuleRepositoryInterface as ModuleRepository;
use Illuminate\Support\Facades\Cache;

// use Illuminate\Support\Facades\App;

class ModuleController extends BackendController
{
    protected $moduleService;
    protected $moduleRepository;
    protected $asset;
    public function __construct(ModuleService $moduleService, ModuleRepository $moduleRepository){
        /** @var App\Services\Interfaces\BaseServiceInterface */
        $this->moduleService = $moduleService;
        /** @var App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->moduleRepository = $moduleRepository;
        $this->asset = asset('backend');
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
            
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config
            ]
        );
    }

    public function index(Request $request){
        $template = 'main.module.index';
        $modules = $this->moduleService->getModules($request);
        // dd($modules);
        $config = [
            'css' => [],
            'script' => [],
        ];
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config,
                'Modules' => $modules,
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
                $this->asset.'/js/autoMachineName.js',
            ]
        ];
    }
}
