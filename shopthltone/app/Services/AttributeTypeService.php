<?php
namespace App\Services;
use App\Services\BaseService;
use App\Services\Interfaces\AttributeTypeServiceInterface;
use App\Repositories\Interfaces\AttributeTypeRepositoryInterface as AttributeTypeRepository;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AttributeTypeService extends BaseService implements AttributeTypeServiceInterface
{
    protected $attributeTypeRepository;
    protected $routerRepository;
    protected $controllerName;
    protected $languageId;
    public function __construct(AttributeTypeRepository $attributeTypeRepository, RouterRepository $routerRepository){
        $this->attributeTypeRepository = $attributeTypeRepository;
        $this->routerRepository = $routerRepository;
        $this->controllerName = 'AttributeTypeController';
        $this->languageId = $this->currentLanguage();
    }
    public function destroy($id){
        DB::beginTransaction();
        try {
            $this->attributeTypeRepository->forceDelete($id);
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
            $attributeType = $this->attributeTypeRepository->findByID($id);
            $flag = $this->uploadAttributeType($id,$request);
            if ($flag) {
                $this->updateLanguageForAttributeType($attributeType,$request);
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
            $attributeType = $this->createAttributeType($request);
            if ($attributeType->id > 0) {
                $this->updateLanguageForAttributeType($attributeType,$request);
                $this->createRouter($attributeType->id,$request,$this->controllerName, $this->languageId);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function getAttributeTypes(Request $request, $pagination=false){
        $condition = $request->except('search');
        if (isset($condition['keyword'])) {
            $condition['keyword'] = addslashes($condition['keyword']);
        }
        $perPage = isset($condition['perpage']) ? intval($condition['perpage']) : 20;
        $condition['where'] = [
            ['tb2.language_id','=',$this->currentLanguage()],
        ];
        $attributeTypes = $this->attributeTypeRepository->getDataPagination(
            $this->selected(),
            $condition,
            [
                ['attribute_type_languages as tb2','tb2.attribute_type_id','=','attribute_types.id'],
            ],
            $perPage,
            ['path'=>'admin/product/attype/attype','groupBy'=>$this->selected()],
            [],
            [],
            $pagination,
            ['attribute_types.id','DESC']
        );
        return $attributeTypes;
    }
    private function createAttributeType($request)
    {
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        $payload['album'] = $this->formatAlbum($payload);
        $postCat = $this->attributeTypeRepository->create($payload);
        return $postCat;
    }
    private function uploadAttributeType($id,$request)
    {
        $payload = $request->only($this->payload());
        $payload['album'] = $this->formatAlbum($payload);
        return $this->attributeTypeRepository->update($id,$payload);
    }
    private function updateLanguageForAttributeType($model,$request)
    {
        $payloadLanguage = $request->only($this->payloadLanguage());
        $payloadLanguage = $this->formatLanguagePayload($payloadLanguage,$model);
        $model->languages()->detach([$payloadLanguage['language_id'],$model->id]);
        return $this->attributeTypeRepository->createPivot($model,$payloadLanguage,'languages');
    }
    private function formatLanguagePayload($payload,$model)
    {
        $payload['canonical'] = Str::slug($payload['canonical']);
        $payload['language_id'] = $this->currentLanguage();
        $payload['attribute_type_id'] = $model->id;
        return $payload;
    }
    private function payloadLanguage()
    {
        return ['name','canonical','description','content','meta_title','meta_keyword','meta_desc'];
    }
    private function payload()
    {
        return ['parentid','publish','image','album'];
    }
    private function selected()
    {
        return [
            'attribute_types.id',
            'attribute_types.publish',
            'attribute_types.order',
            'attribute_types.image',
            'attribute_types.album',
            'tb2.name',
            'tb2.canonical',
        ];
    }
    
}