<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;

class RouterController extends FrontendController
{
    protected $routerRepository;
    protected $router;
    public function __construct(RouterRepository $routerRepository){
        parent::__construct();
        $this->routerRepository = $routerRepository;
    }
    public function index($canonical, Request $request){
        $this->getRouter($canonical);
        if(!is_null($this->router) && !empty($this->router)){
            $controller = $this->router->first()->controller;
            $moduleId = $this->router->first()->module_id;
            $method = 'index';
            echo app($controller)->{$method}($moduleId, $request);
        }else{
            abort(404);
        }
    }
    public function page(string $canonical = '', $page = 1, Request $request){
        $this->getRouter($canonical);
        $page = (!isset($page)) ? 1 : $page;
        if(!is_null($this->router) && !empty($this->router)){
            $controller = $this->router->first()->controller;
            $moduleId = $this->router->first()->module_id;
            $method = 'index';
            echo app($controller)->{$method}($moduleId, $request, $page);
        }else{
            abort(404);
        }
    }
    public function getRouter($canonical){
        $this->router = $this->routerRepository->findByCondition(
            ['*'],
            [
                ['canonical', '=', $canonical],
                ['language_id', '=', $this->language]
            ]
        );
    }
}
