<?php
namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){

    }

    public function changeStatus(Request $request){
        $post = $request->input();
        // dd($post);
        $serviceInterfaceNamespace = 'App\Services\\'.ucfirst($post['model']).'Service';
        if (class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
            $serviceInstance->changeStatus($post);
        }
        
    }
    public function changeStatusAll(Request $request){
        $post = $request->input();
        // dd($post);
        $flag = false;
        $serviceInterfaceNamespace = 'App\Services\\'.ucfirst($post['model']).'Service';
        if (class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
            $flag = $serviceInstance->changeStatusAll($post);
        }
        return response()->json(['flag'=>$flag]);
    }
}