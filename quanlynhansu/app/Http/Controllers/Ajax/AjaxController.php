<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    protected $userService;
    public function __construct(){

    }
    public function getLocation(Request $request){
        $payload = $request->except('_token');
        $code = $payload['code'];
        $model = trim($payload['model']);
        $location = strtolower(trim($payload['location'])).'_code';
        $repository = 'App\Repositories\\'.ucfirst($model).'Repository';
        $flag = false;
        if (class_exists($repository)) {
            $repoInstance = app($repository);
            $condition = [
                'where' => [
                    [$location, '=', $code]
                ]
            ];
            $flag = true;
            $ret = $repoInstance->findByCondition(['code', 'name'], $condition);
        }
        return response()->json([
            'code' => $flag,
            'ret' => $ret
        ]);
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
