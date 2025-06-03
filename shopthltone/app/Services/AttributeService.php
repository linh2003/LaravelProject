<?php
namespace App\Services;

use App\Services\BaseService;
use App\Services\Interfaces\AttributeServiceInterface;
use App\Repositories\Interfaces\AttributeRepositoryInterface as AttributeRepository;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AttributeService extends BaseService implements AttributeServiceInterface
{
    protected $attributeRepository;
    protected $controllerName;
    public function __construct(AttributeRepository $attributeRepository, RouterRepository $routerRepository){
        parent::__construct($routerRepository);
        $this->attributeRepository = $attributeRepository;
        $this->controllerName = 'Product\AttributeController';
    }
    public function deleteAll($ids){
        // dd($ids);
        DB::beginTransaction();
        try {
            $select = ['id'];
            $condition = [
                'wherein' => ['id' => $ids]
            ];
            // dd($condition);
            $flag = $this->attributeRepository->destroyCondition($select, $condition, []);
            // dd($flag);
            if ($flag) {
                $this->deleteMultipleRouter($ids, $this->controllerName);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function remove($id){
        // dd($id);
        DB::beginTransaction();
        try {
            $flag = $this->attributeRepository->destroy($id);
            if ($flag) {
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
        // dd($request->input());
        DB::beginTransaction();
        try {
            $attribute = $this->updateAttribute($id, $request);
            // dd($attribute);
            if ($attribute->id > 0) {
                $this->updateLanguageForAttribute($request, $attribute, $this->languageCurent->id);
                $this->updateAttributeTypeForAttribute($request, $attribute);
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
            $attribute = $this->createAttribute($request);
            // dd($attribute);
            if ($attribute->id > 0) {
                $this->updateLanguageForAttribute($request, $attribute, $this->languageCurent->id);
                $this->updateAttributeTypeForAttribute($request, $attribute);
                $this->createRouter($request, $attribute->id, $this->controllerName);
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
        return $this->attributeRepository->updateWhereIn('id', $ids, $condition);
    }
    public function changeStatus($request){
        DB::beginTransaction();
        try {
            $id = $request['modelId'];
            $field = $request['field'];
            $value = ($request['value'] == 1) ? config('apps.general.unpublish') : config('apps.general.publish');
            // dd($value);
            $condition = [$field => $value];
            $this->attributeRepository->update($id, $condition);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function updateAttributeTypeForAttribute($request, $model){
        $payload = $request->only('attributeType');
        return $this->attributeRepository->syncData($model, $payload['attributeType'], 'attribute_types');
    }
    public function getAttribute($id = ''){
        $join = [['attribute_language as tb2', 'attributes.id', '=', 'tb2.attribute_id']];
        $languageId = $this->languageCurent->id;
        return $this->attributeRepository->getAttribute($id, $languageId);
    }
    public function getData($request, $counter = false, $join = []){
        $select = $this->select();
        $condition = $request->except('search');
        $condition['where'] = [['tb2.language_id', '=', $this->languageCurent->id]];
        // dd($condition);
        $join = [
            [
            'attribute_language as tb2',
            'attributes.id',
            '=',
            'tb2.attribute_id'
            ]
        ];
        return $this->attributeRepository->getData($select, $condition, $counter, $join);
    }
    private function updateLanguageForAttribute($request, $attribute, $languageId){
        $payload = $this->formatLanguageForAttribute($request);
        $attribute->languages()->detach([$attribute->id, $languageId]);
        return $this->attributeRepository->createPivot($attribute, $payload, 'languages');
    }
    private function formatLanguageForAttribute($request){
        $payload = $request->only($this->payloadLanguage());
        $payload['canonical'] = Str::slug($payload['canonical']);
        $payload['language_id'] = $this->languageCurent->id;
        return $payload;
    }
    private function updateAttribute($id, $request){
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        return $this->attributeRepository->update($id, $payload);
    }
    private function createAttribute($request){
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        return $this->attributeRepository->create($payload);
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
            'image',
            'publish',
            'follow',
            'user_id',
        ];
    }
    private function select(){
        return [
            'id',
            'image',
            'publish',
            'follow',
            'order',
            'tb2.name'
        ];
    }
}