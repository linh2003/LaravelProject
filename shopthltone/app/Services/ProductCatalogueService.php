<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Services\BaseService;
use App\Services\Interfaces\ProductCatalogueServiceInterface;
use App\Repositories\Interfaces\ProductCatalogueRepositoryInterface as ProductCatalogueRepository;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use Illuminate\Support\Facades\Auth;
use App\Classes\Nestedsetbie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCatalogueService extends BaseService implements ProductCatalogueServiceInterface
{
    protected $productCatalogueRepository;
    protected $nestedsetbie;
    protected $controllerName;
    public function __construct(ProductCatalogueRepository $productCatalogueRepository, RouterRepository $routerRepository){
        parent::__construct($routerRepository);
        $this->productCatalogueRepository = $productCatalogueRepository;
        $this->nestedsetbie = new Nestedsetbie([
            'table' => 'product_catalogues',
            'foreignkey' => 'product_catalogue_id',
            'language_id' => $this->languageCurent->id,
        ]);
        $this->controllerName = 'Product\ProductCatalogueController';
    }
    public function getProductForPromotion($payload){
        $ret = $this->nestedsetbie->hierarchyWithCheckbox();
        return $ret;
    }
    public function getNestable($id = 0, $route = 'product.catalogue.edit'){
        return $this->nestedsetbie->getNestable($id, $route);
    }
    public function getAlbum($id){
        $ret = $this->productCatalogueRepository->findById($id, ['album']);
        return json_decode($ret->album, true);
    }
    public function getDropdown($param = []){
        $dropdown = $this->nestedsetbie->Dropdown($param);
        return $dropdown;
    }
    public function getProductCatalogue($id){
        $productCat = $this->productCatalogueRepository->getProductCatalogue($id, $this->languageCurent->id);
        return $productCat;
    }
    public function remove($id){
        DB::beginTransaction();
        try {
            $flag = $this->productCatalogueRepository->destroy($id);
            // dd($flag);
            if ($flag) {
                $this->nestedSet();
                $this->deleteRouter($id, $this->controllerName);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function update($id, $request){
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload());
            $productCatalogue = $this->updateProductCatalogue($id, $payload);
            // dd($flag);
            if($productCatalogue){
                //Thêm dữ liệu vào table product catalogue language
                $this->updatePayloadLanguage($request, $productCatalogue, $this->languageCurent->id);
                //Thêm dữ liệu vào router
                $this->updateRouter($request, $id, $this->controllerName);
                // Nestedset
                $this->nestedSet();
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function create($request){
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload());
            $productCatalogue = $this->createProductCatalogue($payload);
            if($productCatalogue->id > 0){
                //Thêm dữ liệu vào table product catalogue language
                $this->updatePayloadLanguage($request, $productCatalogue, $this->languageCurent->id);
                //Thêm dữ liệu vào router
                $this->createRouter($request, $productCatalogue->id, $this->controllerName);
                // Nestedset
                $this->nestedSet();
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    private function updateProductCatalogue($id, $payload){
        $payloadFormat = $this->formatPayload($payload);
        return $this->productCatalogueRepository->update($id, $payloadFormat);
    }
    private function createProductCatalogue($payload){
        $payloadFormat = $this->formatPayload($payload);
        return $this->productCatalogueRepository->create($payloadFormat);
    }
    private function updatePayloadLanguage($request, $productCatalogue, $langugeId){
        $payloadLanguage = $this->formatPayloadLanguage($request);
        $productCatalogue->languages()->detach([$productCatalogue->id, $langugeId]);
        $this->productCatalogueRepository->createPivot($productCatalogue, $payloadLanguage, 'languages');
    }
    private function formatPayloadLanguage($request){
        $payloadLanguage = $request->only($this->payloadLanguage());
        $payloadLanguage['canonical'] = Str::slug($payloadLanguage['canonical']);
        $payloadLanguage['language_id'] = $this->languageCurent->id;
        return $payloadLanguage;
    }
    private function nestedSet(){
        $this->nestedsetbie->Get();
        $this->nestedsetbie->Recursive(0, $this->nestedsetbie->Set());
        $this->nestedsetbie->Action();
    }
    private function formatPayload($payload){
        $payload['album'] = $this->formatAlbum($payload);
        $payload['user_id'] = Auth::id();
        // dd($payload);
        return $payload;
    }
    private function payloadLanguage(){
        return [
            'name',
            'description',
            'content',
            'meta_title',
            'meta_desc',
            'meta_keyword',
            'canonical',
        ];
    }
    private function payload(){
        return [
            'parentid',
            'image',
            'album',
            'publish',
            'follow',
        ];
    }
}