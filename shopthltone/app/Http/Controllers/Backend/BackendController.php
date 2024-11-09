<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class BackendController extends Controller
{
    public function __construct()
    {

    }
    public function dashboard(){
        $config = [
            'js' => $this->scripts()];
        $template = 'backend.home.index';
        return view(
            'backend.layout',
            [
                "template" => $template,
                'scripts' => $config['js']
            ]
        );
    }
    private function scripts(){
        $url = URL::to('');
        $scripts = [
            $url.'/backend/js/plugins/flot/jquery.flot.js',
            $url.'/backend/js/plugins/flot/jquery.flot.tooltip.min.js',
            $url.'/backend/js/plugins/flot/jquery.flot.spline.js',
            $url.'/backend/js/plugins/flot/jquery.flot.resize.js',
            $url.'/backend/js/plugins/flot/jquery.flot.pie.js',
            $url.'/backend/js/plugins/flot/jquery.flot.symbol.js',
            $url.'/backend/js/plugins/flot/jquery.flot.time.js',
            $url.'/backend/js/plugins/peity/jquery.peity.min.js',
            $url.'/backend/js/demo/peity-demo.js',
            $url.'/backend/js/inspinia.js',
            $url.'/backend/js/plugins/pace/pace.min.js',
            // $url.'/backend/js/plugins/jquery-ui/jquery-ui.min.js',
            $url.'/backend/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js',
            $url.'/backend/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
            $url.'/backend/js/plugins/easypiechart/jquery.easypiechart.js',
            $url.'/backend/js/plugins/sparkline/jquery.sparkline.min.js',
            $url.'/backend/js/demo/sparkline-demo.js',
        ];
        return $scripts;
    }
}
