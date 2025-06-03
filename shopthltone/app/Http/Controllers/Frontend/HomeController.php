<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Http\Request;
use App\Services\Interfaces\WidgetServiceInterface as WidgetService;

class HomeController extends FrontendController
{
    protected $widgetService;
    public function __construct(WidgetService $widgetService){
        parent::__construct();
        $this->widgetService = $widgetService;
    }
    public function index(){
        $widgetSale = $this->widgetService->saleProduct();
        $widgetPopular = $this->widgetService->popularProduct();
        $config = $this->config();
        $system = $this->system;
        $seo = [
            'meta_title' => $system['seo_title'],
            'meta_keyword' => $system['seo_keyword'],
            'meta_description' => $system['seo_content'],
            'meta_image' => $system['seo_image'],
            'canonical' => config('app.url')
        ];
        // dd($widgetPopular);
        $template = 'frontend.home.index';
        return view('frontend.layout',[
            'template' => $template,
            'config' => $config,
            'sale' => $widgetSale,
            'popular' => $widgetPopular,
            'system' => $system,
            'seo' => $seo,
        ]);
    }
    private function config(){
        return [
            'css' => [
                $this->asset.'frontend/css/plugins/slick/slick.css',
                $this->asset.'frontend/css/plugins/slick/slick-theme.css',
            ],
            'script' => [
                $this->asset.'backend/js/plugins/slick/slick.min.js',
                $this->asset.'frontend/js/setupSlickCarousel.js',
            ]
        ];
    }
    
}
