<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AttributeRepositoryInterface as AttributeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    protected $attributeRepository;
    protected $language;
    public function __construct(AttributeRepository $attributeRepository){
        $this->attributeRepository = $attributeRepository;
        $this->language = $this->currentLanguage();
    }

    public function changeStatusAll(Request $request){
        $post = $request->input();
        $service = 'App\Services\\'.ucfirst($post['model']).'Service';
        $flag = false;
        if (class_exists($service)) {
            $serviceInstance = app($service);
            $flag = $serviceInstance->changeStatusAll($post);
        }
        return response()->json(['flag'=>$flag]);
    }
    public function changeStatus(Request $request){
        $post = $request->input();
        $service = 'App\Services\\'.ucfirst($post['model']).'Service';
        if (class_exists($service)) {
            $serviceInstance = app($service);
            $serviceInstance->changeStatus($post);
        }
    }
    public function getAttribute(Request $req){
        // dd($req);
        $payload = $req->input();
        $attributes = $this->attributeRepository->searchAttributes($payload['search'],$payload['option'],$this->language);
        $attrMapped = $attributes->map(function($attribute){
            return [
                'id' => $attribute->id,
                'text' => $attribute->attribute_languages->first()->name,
            ];
        })->all();
        return response()->json(array('items' => $attrMapped));
    }
    public function loadAttribute(Request $request){
        $payload['attribute'] = json_decode(base64_decode($request->input('attribute') ), TRUE );
        $payload['attributeType'] = $request->input('attributeType');
        $attributeArr = $payload['attribute'][$payload['attributeType']];
        $attributes = [];
        if(count($attributeArr)){
            $attributes = $this->attributeRepository->findAttributeByIdArrray($attributeArr, $this->currentLanguage());
        }
        $temp = [];
        if(count($attributes)){
            foreach ($attributes as $key => $val) {
                $temp[] = [
                    'id' => $val->id,
                    'text' => $val->name,
                ];
            }
        }
        return response()->json(array('items' => $temp));
    }
    private function currentLanguage(){
        $lang = DB::table('languages')->where('active','=',1)->value('id');
        return $lang;
    }
}
