<?php
namespace App\Services;
use App\Services\Interfaces\ProductCatServiceInterface;
use App\Services\BaseService;
use App\Repositories\Interfaces\ProductCatRepositoryInterface as ProductCatRepository;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Classes\Nestedsetbie;

class ProductCatService extends BaseService implements ProductCatServiceInterface
{
    protected $productCatRepository;
    protected $userRepository;
    protected $languageId;
    protected $nestedset;
    public function __construct(ProductCatRepository $productCatRepository, RouterRepository $routerRepository){
        $this->productCatRepository = $productCatRepository;
        $this->controllerName = 'ProductCatalogueController';
        $this->routerRepository = $routerRepository;
        $this->languageId = $this->currentLanguage();
        $this->nestedset = new Nestedsetbie([
            'table' => 'product_catalogues',
            'foreignkey' => 'product_catalogue_id',
            'language_id' => $this->currentLanguage(),
        ]);
    }
    public function update($id,Request $request){
        DB::beginTransaction();
        try {
            $productCat = $this->productCatRepository->findByID($id);
            $flag = $this->uploadProductCat($id,$request);
            if ($flag) {
                $this->updateLanguageForProductCat($productCat,$request);
                $this->updateRouter($id,$request,$this->controllerName);
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
    public function getProductCatalogues(){
        $productCat = $this->productCatRepository->getDataPagination(
            $this->selected(),
            [],
            [
                ['product_catalogue_languages as tb2', 'tb2.product_catalogue_id', '=', 'product_catalogues.id']
            ],
            0,
            ['path'=>'admin/product/cat'],
            [],
            [],
            false,
            ['product_catalogues.lft','ASC']
        );
        return $productCat;
    }
    public function create(Request $request){
        DB::beginTransaction();
        try {
            $productCat = $this->createProductCatalogue($request);
            if ($productCat->id > 0) {

                $this->updateLanguageForProductCatalogue($productCat, $request);
                // dd('dieptvvv123');
                $this->createRouter($productCat->id, $request, $this->controllerName, $this->languageId);

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
    private function updateLanguageForProductCatalogue($productCat, $request)
    {
        $payloadLanguage = $request->only($this->payloadLanguage());
        $payloadLanguage = $this->formatLanguagePayload($payloadLanguage, $productCat);
        $productCat->languages()->detach([$payloadLanguage['language_id'], $productCat->id]);
        return $this->productCatRepository->createPivot($productCat, $payloadLanguage, 'languages');
    }
    private function createProductCatalogue($request)
    {
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        $payload['album'] = $this->formatAlbum($payload);
        $productCat = $this->productCatRepository->create($payload);
        return $productCat;
    }
    private function formatLanguagePayload($payload,$productCat)
    {
        $payload['canonical'] = Str::slug($payload['canonical']);
        $payload['language_id'] = $this->currentLanguage();
        $payload['product_catalogue_id'] = $productCat->id;
        return $payload;
    }
    public function nestedSet()
    {
        $this->nestedset->Get();
        $this->nestedset->Recursive(0,$this->nestedset->Set());
        $this->nestedset->Action();
    }
    private function payloadLanguage()
    {
        return ['name', 'canonical', 'description', 'content', 'meta_title', 'meta_keyword', 'meta_desc'];
    }
    private function payload()
    {
        return ['parentid', 'publish', 'follow', 'image', 'album'];
    }
    private function selected()
    {
        return [
            'product_catalogues.id',
            'product_catalogues.lft',
            'product_catalogues.rgt',
            'product_catalogues.level',
            'product_catalogues.publish',
            'product_catalogues.order',
            'tb2.name',
            'tb2.canonical',
        ];
    }
}