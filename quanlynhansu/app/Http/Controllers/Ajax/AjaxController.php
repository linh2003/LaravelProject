<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    protected $userService;
    public function __construct(){

    }
    public function switchStatus(Request $request){
        $payload = $request->except('_token');
        $model = $payload['model'];
        $service = 'App\Services\\'.ucfirst($model).'Service';
        if (class_exists($service)) {
            $serviceInstance = app($service);
            $serviceInstance->changeStatus($payload);
        }
    }
    public function changeStatusAll(Request $request){
        $payload = $request->except('_token');
        $model = $payload['model'];
        $service = 'App\Services\\'.ucfirst($model).'Service';
        if (class_exists($service)) {
            $serviceInstance = app($service);
            $serviceInstance->changeStatusAll($payload);
        }
        return response()->json(['code' => true]);
    }
}
