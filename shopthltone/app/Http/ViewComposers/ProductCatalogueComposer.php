<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface as ProductCatalogueRepository;
use App\Repositories\Interfaces\PromotionRepositoryInterface as PromotionRepository;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use Illuminate\Support\Facades\DB;

class ProductCatalogueComposer
{
    protected $productCatalogueRepository;
    protected $promotionRepository;
    protected $languageRepository;
    protected $routerRepository;
    public function __construct(ProductCatalogueRepository $productCatalogueRepository, PromotionRepository $promotionRepository, LanguageRepository $languageRepository, RouterRepository $routerRepository){
        $this->productCatalogueRepository = $productCatalogueRepository;
        $this->promotionRepository = $promotionRepository;
        $this->languageRepository = $languageRepository;
        $this->routerRepository = $routerRepository;
    }
    public function compose(View $view){
        $language = $this->languageRepository->findByCondition(
            ['id'], 
            [['active', '=', 1]]
        );
        $productCataloguesParent = $this->productCatalogueRepository->findByCondition(
            ['id', 'tb2.name', 'image'],
            [
                ['level', '=', 1],
                ['publish', '=', 1],
                ['tb2.language_id', '=', $language->first()->id],
            ],
            [
                ['product_catalogue_language as tb2', 'product_catalogues.id', '=', 'tb2.product_catalogue_id']
            ]
        );
        $productCataloguesChild = $this->productCatalogueRepository->findByCondition(
            ['id', 'tb2.name', 'image'],
            [
                ['level', '!=', 1],
                ['publish', '=', 1],
                ['tb2.language_id', '=', $language->first()->id],
            ],
            [
                ['product_catalogue_language as tb2', 'product_catalogues.id', '=', 'tb2.product_catalogue_id']
            ]
        );
        $catPromotion = $this->productCatalogueRepository->findByCondition(
            ['product_catalogues.id AS id', DB::raw('MAX(promotions.discount_value) AS max_discount')],
            [
                ['promotions.status', '=', 1],
                ['promotions.end', '>', now()],
                ['product_catalogues.publish', '=', 1],
                ['tb2.language_id', '=', $language->first()->id],
            ],
            [
                ['product_catalogue_language as tb2', 'product_catalogues.id', '=', 'tb2.product_catalogue_id'], 
                ['promotion_module as pm', 'product_catalogues.id', '=', 'pm.module_id'],
                ['promotions', 'promotions.id', '=', 'pm.promotion_id']
            ],
            ['product_catalogues.id', 'tb2.name']
        );
        // dd($catPromotion->toArray());
        $routerCat = $this->routerRepository->findByCondition(
            ['module_id', 'canonical'],
            [
                ['controller', '=', 'App\Http\Controllers\Frontend\Product\ProductCatalogueController'],
                ['language_id', '=', $language->first()->id]
            ]
        );
        // dd($routerCat);
        $catParent = $this->mergeDataCatalogue($productCataloguesParent, $catPromotion, $routerCat);
        $catChild = $this->mergeDataCatalogue($productCataloguesChild, $catPromotion, $routerCat);
        $catData = [
            'catParent' => $catParent,
            'catChild' => $catChild,
        ];
        // dd($catData);
        $view->with('catData', $catData);
    }
    private function mergeDataCatalogue($catData, $catPromotion, $routeData){
        $data = [];
        foreach ($catData as $k => $cat) {
            foreach ($routeData as $r) {
                if ($cat->id == $r->module_id) {
                    $data[$cat->id] = [
                        'name' => $cat->name, 
                        'image' => $cat->image, 
                        'canonical' => $r->canonical
                    ];
                }
            }
            foreach ($catPromotion as $val) {
                if ($cat->id == $val->id) {
                    $data[$cat->id]['promotion'] = $val->max_discount;
                }
            }
        }
        return $data;
    }
}