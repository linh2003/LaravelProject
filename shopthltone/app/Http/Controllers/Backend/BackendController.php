<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendController extends Controller
{
    public function __construct(){

    }
    public function index(){
        
        $template = 'backend.home.index';
        return view(
            'backend.layout',
            [
                'template' => $template
            ]
        );
    }
}
