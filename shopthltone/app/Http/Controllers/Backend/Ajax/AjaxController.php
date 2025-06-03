<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\AttributeRepositoryInterface as AttributeRepository;
use App\Services\Interfaces\AttributeServiceInterface as AttributeService;
use App\Services\Interfaces\ProductServiceInterface as ProductService;

class AjaxController extends Controller
{
    protected $attributeRepository;
    protected $productService;
    public function __construct(AttributeRepository $attributeRepository, ProductService $productService){
        $this->attributeRepository = $attributeRepository;
        $this->productService = $productService;
    }
    public function sendAttribute(Request $request){
        $payload = $request->input();
        // dd($payload);
        $product = $this->productService->getProductForProductDetail($payload['id'], $payload['attr']);
        // dd($product);
        return response()->json($product);
    }
    public function getProduct(Request $request){
        $payload = $request->input();
        $model = ucfirst(trim($payload['model']));
        $service = 'App\Services\\'.$model.'Service';
        // dd(vars: $payload);
        if (class_exists($service)) {
            $serviceInstance = app($service);
            $object = $serviceInstance->getProductForPromotion($payload);
            // dd($object);
            return response()->json([
                'model' => $payload['model'],
                'object' => $object
            ]);
        }

    }
    public function loadAttrVariant(Request $request){
        $attr = $request->input('attribute');
        // dd($attr);
        $attrs = $this->attributeRepository->loadAttribute([], [], $attr);
        // dd($attrs);
        return response()->json($attrs);
    }
    public function getAttrByAttrType(Request $request){
        $payload = $request->input();
        $keyword = $payload['search'];
        $attrType = $payload['option']['attributeTypeId'];
        $attr = $this->attributeRepository->searchAttribute($keyword, $attrType);
        $ret = $attr->map(function($item){
            return [
                'id' => $item->id,
                'text' => $item->attribute_language()->first()->name
            ];
        })->all();
        // dd($ret);
        return response()->json($ret);
    }
    public function changeStatus(Request $request){
        $payload = $request->input();
        $model = $payload['model'];
        $service = 'App\Services\\'.ucfirst($model).'Service';
        if (class_exists($service)) {
            $serviceInstance = app($service);
            $flag = $serviceInstance->changeStatus($payload);
        }
        return response()->json(['flag' => $flag]);
    }
    public function changestatusAll(Request $request){
        $payload = $request->input();
        $model = $payload['model'];
        $service = 'App\Services\\'.ucfirst($model).'Service';
        if (class_exists($service)) {
            $serviceInstance = app($service);
            $flag = $serviceInstance->changeStatusAll($payload);
        }
        return response()->json(['flag' => $flag]);
    }
}
