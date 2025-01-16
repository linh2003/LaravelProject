<?php
namespace App\Services;
use App\Services\BaseService;
use App\Services\Interfaces\AttributeServiceInterface;
use App\Repositories\Interfaces\AttributeRepositoryInterface as AttributeRepository;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AttributeService extends BaseService implements AttributeServiceInterface
{
    protected $attributeRepository;
    protected $routerRepository;
    protected $controllerName;
    protected $languageId;
    public function __construct(AttributeRepository $attributeRepository, RouterRepository $routerRepository){
        $this->attributeRepository = $attributeRepository;
        $this->routerRepository = $routerRepository;
        $this->controllerName = 'AttributeController';
        $this->languageId = $this->currentLanguage();
    }
    public function destroy($id){
        DB::beginTransaction();
        try {
            $this->attributeRepository->forceDelete($id);
            // dd('123');
            $condition = [
                ['module_id', '=', $id],
                ['controller', '=', 'App\Http\Controllers\Frontend\\'.$this->controllerName],
            ];
            $this->routerRepository->forceDeleteByCondition($condition);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }

    public function update($id,Request $request){
        DB::beginTransaction();
        try {
            $attribute = $this->attributeRepository->findByID($id);
            $flag = $this->uploadAttribute($id,$request);
            if ($flag) {
                $this->updateLanguageForAttribute($attribute,$request);
                $this->updateCatalogueForAttribute($attribute,$request);
                $this->updateRouter($id,$request,$this->controllerName, $this->languageId);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }

    public function create(Request $request){
        DB::beginTransaction();
        try {
            $attribute = $this->createAttribute($request);
            if ($attribute->id > 0) {
                $this->updateLanguageForAttribute($attribute,$request);
                $this->updateCatalogueForAttribute($attribute,$request);
                $this->createRouter($attribute->id,$request,$this->controllerName, $this->languageId);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function getAttributes(Request $request, $pagination=false){
        $condition = $request->except('search');
        if (isset($condition['keyword'])) {
            $condition['keyword'] = addslashes($condition['keyword']);
        }
        $perPage = isset($condition['perpage']) ? intval($condition['perpage']) : 20;
        $condition['where'] = [
            ['tb2.language_id','=',$this->currentLanguage()],
        ];
        $attributes = $this->attributeRepository->getDataPagination(
            $this->selected(),
            $condition,
            [
                ['attribute_languages as tb2','tb2.attribute_id','=','attributes.id'],
            ],
            $perPage,
            ['path'=>'admin/product/attribute/attribute','groupBy'=>$this->selected()],
            [],
            [],
            $pagination,
            ['attributes.id','DESC']
        );
        return $attributes;
    }
    private function createAttribute($request)
    {
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        $payload['album'] = $this->formatAlbum($payload);
        $postCat = $this->attributeRepository->create($payload);
        return $postCat;
    }
    private function uploadAttribute($id,$request)
    {
        $payload = $request->only($this->payload());
        $payload['album'] = $this->formatAlbum($payload);
        return $this->attributeRepository->update($id,$payload);
    }
    private function updateLanguageForAttribute($model,$request)
    {
        $payloadLanguage = $request->only($this->payloadLanguage());
        $payloadLanguage = $this->formatLanguagePayload($payloadLanguage,$model);
        $model->languages()->detach([$payloadLanguage['language_id'],$model->id]);
        return $this->attributeRepository->createPivot($model,$payloadLanguage,'languages');
    }
    private function formatLanguagePayload($payload,$model)
    {
        $payload['canonical'] = Str::slug($payload['canonical']);
        $payload['language_id'] = $this->currentLanguage();
        $payload['attribute_id'] = $model->id;
        return $payload;
    }
    private function updateCatalogueForAttribute($attribute,$request){
        $attribute->attribute_types()->sync($this->attributeTypes($request));
    }
    private function attributeTypes($request){
        $arg = $request->input('attributeType');
        if (!$arg) {
            $arg = [];
        }
        return $arg;
    }
    private function payloadLanguage()
    {
        return ['name','canonical','description','content','meta_title','meta_keyword','meta_desc'];
    }
    private function payload()
    {
        return ['attribute_type_id','publish','image','album'];
    }
    private function selected()
    {
        return [
            'attributes.id',
            'attributes.publish',
            'attributes.order',
            'attributes.image',
            'attributes.album',
            'tb2.name',
            'tb2.canonical',
        ];
    }
    
}