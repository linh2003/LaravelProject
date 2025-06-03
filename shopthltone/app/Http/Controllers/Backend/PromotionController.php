<?php

namespace App\Http\Controllers\Backend;

use App\Enums\Promotion;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\PromotionRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\PromotionServiceInterface as PromotionService;
use App\Repositories\Interfaces\PromotionRepositoryInterface as PromotionRepository;
use App\Rules\Promotion\PromotionObjectRule;

class PromotionController extends BackendController
{
    protected $promotionService;
    protected $promotionRepository;
    public function __construct(PromotionService $promotionService, PromotionRepository $promotionRepository){
        parent::__construct();
        $this->promotionService = $promotionService;
        $this->promotionRepository = $promotionRepository;
    }
    public function remove($id){
        if($this->promotionService->remove($id)){
            return redirect()->route('admin.promotion')->with('success', __('promotion.message.delete.success'));
        }
        return redirect()->route('admin.promotion')->with('error', __('promotion.message.delete.error'));
    }
    public function update($id, PromotionRequest $request){
        if ($this->promotionService->update($id, $request)) {
            return redirect()->route('admin.promotion')->with('success',__('promotion.message.update.success'));
        }
        return redirect()->route('admin.promotion')->with('error',__('promotion.message.update.error'));
    }
    public function edit($id){
        $template = 'backend.promotion.promotion.store';
        $heading = __('promotion');
        $general = __('general');
        $config = $this->config();
        $method = 'update';
        $promotion = $this->promotionRepository->findById($id);
        $moduleConst = [Promotion::PROMOTION_PRODUCT];
        // dd($promotion->discount);
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'heading'   => $heading,
                'general'   => $general,
                'config'    => $config,
                'method'    => $method,
                'promotion'    => $promotion,
                'moduleConst'  => $moduleConst,
            ]
        );
    }
    public function store(PromotionRequest $request){
        if ($this->promotionService->create($request)) {
            return redirect()->route('admin.promotion')->with('success',__('promotion.message.create.success'));
        }
        return redirect()->route('admin.promotion')->with('error',__('promotion.message.create.error'));
    }
    public function create(){
        $template = 'backend.promotion.promotion.store';
        $heading = __('promotion');
        $general = __('general');
        $config = $this->config();
        $method = 'create';
        return view(
            'backend.layout',
            [
                'template'  => $template,
                'heading'   => $heading,
                'general'   => $general,
                'config'    => $config,
                'method'    => $method
            ]
        );
    }
    public function index(Request $request){
        $template = 'backend.promotion.promotion.index';
        $promotion = $this->promotionService->getData($request, false);
        // dd($promotion);
        $counter = $this->promotionService->getData($request, true);
        $heading = __('promotion');
        $general = __('general');
        $config = $this->config();
        $config['script'][] = $this->asset.'/js/customSwitchery.js';
        $config['script'][] = $this->asset.'/js/checkboxList.js';
        $config['config'] = config('apps.general');
        return view(
            'backend.layout',
            [
                'template'    => $template,
                'heading'     => $heading,
                'general'     => $general,
                'config'      => $config,
                'promotion'    => $promotion,
                'counter'     => $counter,
            ]
        );
    }
    private function config(){
        return [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
                // $this->asset.'/css/plugins/iCheck/custom.css',
                $this->asset.'/css/plugins/switchery/switchery.css',
                $this->asset.'/css/plugins/datapicker/datepicker3.css',
                $this->asset.'/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
                $this->asset.'/css/plugins/iCheck/custom.css',
            ],
            'script' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                $this->asset.'/js/customSelect2.js',
                $this->asset.'/js/plugins/switchery/switchery.js',
                $this->asset.'/plugins/ckeditor/ckeditor.js',
                $this->asset.'/js/price.js',
                $this->asset.'/js/plugins/datapicker/bootstrap-datepicker.js',
                $this->asset.'/js/setupDataPicker.js',
                // $this->asset.'/js/plugins/iCheck/icheck.min.js',
                // $this->asset.'/js/icheckSetup.js',
                $this->asset.'/js/promotion.js',
            ]
        ];
    }
}
