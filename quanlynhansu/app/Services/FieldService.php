<?php
namespace App\Services;

use App\Services\Interfaces\FieldServiceInterface;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\FieldRepositoryInterface as FieldRepository;
use App\Repositories\Interfaces\ModuleRepositoryInterface as ModuleRepository;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Constants\Number;

class FieldService extends BaseService implements FieldServiceInterface
{
    protected $fieldRepository;
    protected $moduleRepository;
    protected $languageRepository;
    public function __construct(FieldRepository $fieldRepository, ModuleRepository $moduleRepository, LanguageRepository $languageRepository)
    {
        parent::__construct();
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->fieldRepository = $fieldRepository;
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->moduleRepository = $moduleRepository;
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->languageRepository = $languageRepository;
    }
    
    public function getFieldForModule($moduleId){
        $module = $this->moduleRepository->findById($moduleId, ['code']);
        $code = $module->code ?? '';
        // \Log::info("Cache key: module_config:{$code}");
        return Cache::remember("module_config:{$code}", config('cache.ttl'), function() use ($code) {
            $condition = [
                ['module_code', '=', $code],
                ['publish', '=', Number::PUBLISH],
                ['language_id', '=', $this->language]
            ];
            return $this->fieldRepository->getFieldByCondition($condition);
        });
    }
    public function update($id, Request $request){
        DB::beginTransaction();
        try {
            $payload = $this->formatPayload($request);
            $this->fieldRepository->update($id, $payload);
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
            $this->formatPayload($request);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    private function updateLanguagePivot($payload, $field, $relation){
        // $payload = $this->formatPayload($request);
        $field->{$relation}()->detach([$field->id, $this->language]);
        $this->fieldRepository->createPivot($field, $relation, $payload);
    }
    private function formatPayload($request){
        $payload = $request->only($this->payload());
        foreach ($payload['machine_name'] as $k => $it) {
            $input = [
                'field_code' => Str::slug(convertUnicode($it)),
                'module_code' => $payload['modelId'],
                'vocabulary_id' => $payload['vocabulary_field'][$k],
            ];
            $field = $this->fieldRepository->create($input);
            if ($field->id > 0) {
                $payloadLang = [
                    'field_name' => $payload['field_name'][$k],
                    'language_id' => $this->language
                ];
                $this->updateLanguagePivot($payloadLang, $field, 'languages');
            }
        }
    }
    private function payload(){
        return [
            'modelId',
            'field_name',
            'machine_name',
            'vocabulary_field'
        ];
    }
}
