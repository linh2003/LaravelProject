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
}
