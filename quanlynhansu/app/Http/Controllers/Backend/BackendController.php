<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    protected $asset;
    public function __construct(){
        $this->asset = asset('backend'); /* sitename/public/backend */
    }

    public function dashboard(){
        $config = $this->config();
        $template = 'main.home.dashboard';
        return view(
            'main.layout',
            [
                'template' => $template,
                'config' => $config,
            ]
        );
    }
    private function config(){
        return [
            'css' => [],
            'js' => [],
        ];
    }
}
