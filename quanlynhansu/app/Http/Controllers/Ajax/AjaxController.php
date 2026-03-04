<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    protected $userService;
    public function __construct(){

    }
    public function getVocabulary(Request $request){
        $vocService = 'App\Services\VocabularyService';
        if (class_exists($vocService)) {
            $vocInstance = app($vocService);
            $vocabularies = $vocInstance->getVocabularies();
            // dd($vocabularies);
            return response()->json([
                'flag' => true, 
                'vocabularies' => $vocabularies
            ]);
        }
    }
    public function loadFieldModule(Request $request){
        $payload = $request->except('_token');
        $data = [];
        if (isset($payload['model']) && !empty($payload['model'])) {
            $model = ucfirst(trim($payload['model']));
            $id = $payload['id'];
            $repository = 'App\Repositories\\'.$model.'Repository';
            if (class_exists($repository)) {
                $instance = app($repository);
                $module = $instance->findById($id);
                $data['module'] = $module;
                $fieldService = 'App\Services\FieldService';
                if (class_exists($fieldService)) {
                    $instanceField = app($fieldService);
                    $fields = $instanceField->getFieldForModule($id);
                    $data['fields'] = $fields;
                    // dd($fields);
                }
            }
            return response()->json([
                'flag' => true, 
                'module' => $data['module'] ?? null,
                'fields' => $data['fields'] ?? null,
            ]);
        }
    }
    public function sortData(Request $request){
        $payload = $request->except('_token');
        // dd($payload);
        $json = json_decode($payload['data']);
        $data = [];
        foreach ($json as $key => $it) {
            $data[] = [
                'id' => $it->id,
                'order' => $key
            ];
        }
        // dd($data);
        if (isset($payload['model']) && !empty($payload['model'])) {
            $model = ucfirst(trim($payload['model']));
            $service = 'App\Services\\'.$model.'Service';
            if (class_exists($service)) {
                $instance = app($service);
                $method = 'sort'.$model.'Order';
                $data = $instance->{$method}($data);
                return response()->json([
                    'flag' => true, 
                    'message' => __('general.message.update.success')
                ]);
            }
        }
    }
    public function sortLoadData(Request $request){
        $payload = $request->input();
        if (isset($payload['model']) && !empty($payload['model'])) {
            $model = ucfirst(trim($payload['model']));
            $id = $payload['id'];
            $service = 'App\Services\\'.$model.'Service';
            if (class_exists($service)) {
                $instance = app($service);
                $method = 'get'.$model.'ByCondition';
                $data = $instance->{$method}($id);
                return response()->json([
                    'flag' => true, 
                    'data' => $data
                ]);
            }
        }
    }
    public function quickAdd(Request $request){
        $payload = $request->except('_token');
        if (isset($payload['model']) && !empty($payload['model'])) {
            $model = ucfirst(trim($payload['model']));
            $service = 'App\Services\\'.$model.'Service';
            if (class_exists($service)) {
                $instance = app($service);
                $flag = $instance->createMultiple($payload);
                return response()->json([
                    'flag' => $flag, 
                    'message' => __('general.message.create.success')
                ]);
            }
        }
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
