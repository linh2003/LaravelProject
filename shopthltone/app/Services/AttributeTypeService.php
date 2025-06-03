<?php
namespace App\Services;

use App\Services\BaseService;
use App\Services\Interfaces\AttributeTypeServiceInterface;
use App\Repositories\Interfaces\AttributeTypeRepositoryInterface as AttributeTypeRepository;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AttributeTypeService extends BaseService implements AttributeTypeServiceInterface
{
    protected $attributeTypeRepository;
    protected $controllerName;
    public function __construct(AttributeTypeRepository $attributeTypeRepository, RouterRepository $routerRepository){
        parent::__construct($routerRepository);
        $this->attributeTypeRepository = $attributeTypeRepository;
        $this->controllerName = 'Product\AttributeTypeController';
    }
    public function remove($id){
        dd($id);
        DB::beginTransaction();
        try {
            $this->attributeTypeRepository->destroy($id);
            // dd($flag);
            // dd($attributeType);
            // if ($flag) {
            //     $condition = [
            //         ['tb2.attribute_type_id', '=', $id],
            //         ['tb2.language_id', '=', $this->languageCurent->id],
            //         ['tb2.deleted_at', '=', null],
            //     ];
            //     $join = [
            //         ['attribute_type_language as tb2', 'attribute_types.id', '=', 'tb2.attribute_type_id']
            //     ];
            //     $attributeTypeLang = $this->attributeTypeRepository->findByCondition(['*'], $condition, $join);
            //     $attributeTypeLang->delete();
            //     $conditionRouter = [
            //         ['module_id', '=', $id],
            //         ['controller', '=', $this->controllerPrefix.$this->controllerName],
            //         ['language_id', '=', $this->languageCurent->id],
            //     ];
            //     $router = $this->routerRepository->findByCondition(['*'], $conditionRouter);
            //     $router->delete();
            // }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function update($id, $request){
        // dd($request->input());
        DB::beginTransaction();
        try {
            $attributeType = $this->updateAttributeType($id, $request);
            // dd($attributeType);
            if ($attributeType->id > 0) {
                $this->updateLanguageForAttributeType($request, $attributeType, $this->languageCurent->id);
                $this->updateRouter($request, $id, $this->controllerName);
                // dd(222);
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
            $attributeType = $this->createAttributeType($request);
            
            if ($attributeType->id > 0) {
                $this->updateLanguageForAttributeType($request, $attributeType, $this->languageCurent->id);
                $this->createRouter($request, $attributeType->id, $this->controllerName);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function changeStatusAll($request){
        $ids = $request['modelId'];
        $condition = [$request['field'] => $request['value']];
        return $this->attributeTypeRepository->updateWhereIn('id', $ids, $condition);
    }
    public function changeStatus($request){
        DB::beginTransaction();
        try {
            $id = $request['modelId'];
            $field = $request['field'];
            $value = ($request['value'] == 1) ? config('apps.general.unpublish') : config('apps.general.publish');
            // dd($value);
            $condition = [$field => $value];
            $this->attributeTypeRepository->update('id', $id, $condition);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function getAttributeType($id = ''){
        $languageId = $this->languageCurent->id;
        return $this->attributeTypeRepository->getAttributeType($id, $languageId);
    }
    public function getData(mixed $request = '', $counter = false, $join = []){
        $select = $this->select();
        $condition = $request ? $request->except('search') : [];
        $condition['where'] = [['tb2.language_id', '=', $this->languageCurent->id]];
        // dd($condition);
        $join = [
            [
            'attribute_type_language as tb2',
            'attribute_types.id',
            '=',
            'tb2.attribute_type_id'
            ]
        ];
        return $this->attributeTypeRepository->getData($select, $condition, $counter, $join);
    }
    private function updateLanguageForAttributeType($request, $attributeType, $languageId){
        $payload = $this->formatLanguageForAttributeType($request);
        $attributeType->languages()->detach([$attributeType->id, $languageId]);
        return $this->attributeTypeRepository->createPivot($attributeType, $payload, 'languages');
    }
    private function formatLanguageForAttributeType($request){
        $payload = $request->only($this->payloadLanguage());
        $payload['canonical'] = Str::slug($payload['canonical']);
        $payload['language_id'] = $this->languageCurent->id;
        return $payload;
    }
    private function updateAttributeType($id, $request){
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        return $this->attributeTypeRepository->update($id, $payload);
    }
    private function createAttributeType($request){
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        return $this->attributeTypeRepository->create($payload);
    }
    private function payloadLanguage(){
        return [
            'name',
            'canonical',
            'description',
            'content',
            'meta_title',
            'meta_keyword',
            'meta_description',
        ];
    }
    private function payload(){
        return [
            'publish',
            'follow',
            'user_id',
        ];
    }
    private function select(){
        return [
            'id',
            'publish',
            'follow',
            'order',
            'tb2.name'
        ];
    }
}