<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use Illuminate\Http\Request;
use App\Services\Interfaces\SystemServiceInterface as SystemService;
use App\Classes\System;

class SystemController extends BackendController
{
    protected $system;
    protected $systemService;
    public function __construct(System $system, SystemService $systemService){
        parent::__construct();
        $this->system = $system;
        $this->systemService = $systemService;
    }
    public function store(Request $request){
        if ($this->systemService->save($request)) {
            return redirect()->route('admin.system')->with('success',__('system.message.update.success'));
        }
        return redirect()->route('admin.system')->with('error',__('system.message.update.error'));
    }
    public function index(){
        $template = 'backend.system.index';
        $heading = __('system');
        $general = __('general');
        $system = $this->system->config();
        $config = $this->config();
        $data = $this->systemService->getConfig();

        return view('backend.layout', [
            'template' => $template,
            'heading' => $heading,
            'config' => $config,
            'general' => $general,
            'system' => $system,
            'data' => $data,
        ]);
    }
    private function config(){
        return [
            'css' => [
                $this->asset.'/css/plugins/jasny/jasny-bootstrap.min.css'
            ],
            'script' => [
                $this->asset.'/js/plugins/jasny/jasny-bootstrap.min.js',
                $this->asset.'/plugins/ckfinder_2/ckfinder.js',
                $this->asset.'/js/finder.js',
            ]
        ];
    }
}
