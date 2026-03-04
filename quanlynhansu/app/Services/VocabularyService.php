<?php
namespace App\Services;

use App\Services\Interfaces\VocabularyServiceInterface;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\VocabularyRepositoryInterface as VocabularyRepository;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class VocabularyService extends BaseService implements VocabularyServiceInterface
{
    protected $vocabularyRepository;
    protected $languageRepository;
    public function __construct(VocabularyRepository $vocabularyRepository, LanguageRepository $languageRepository)
    {
        parent::__construct();
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->vocabularyRepository = $vocabularyRepository;
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->languageRepository = $languageRepository;
    }
    public function getVocabularies($condition = []){
        // \Log::info("Cache key: module_config:vocabulary");
        return Cache::remember("module_config:vocabulary", config('cache.ttl'), function() {
            $condition[] = ['tb1.language_id', '=', $this->language];
            return $this->vocabularyRepository->getVocabularies($condition);
        });
    }
    public function getVocabulary(){
        $vocs = $this->vocabularyRepository->getAll();
        $language = $this->languageRepository->getAll();
        $vocabularies = [];
        foreach ($vocs as $k => $voc) {
            $i = 0;
            $vocabularies[$k][0]['voc'] = $this->vocabularyRepository->getVocabularyById($voc->id, $this->language);
            $vocabularies[$k][0]['language'] = $this->language;
            foreach ($language as $key => $lang) {
                if ($lang->id != $this->language) {
                    $i++;
                    $vocabularies[$k][$i]['voc'] = $this->vocabularyRepository->getVocabularyById($voc->id, $lang->id);
                    $vocabularies[$k][$i]['language'] = $lang->id;
                }
            }
        }
        return $vocabularies;
    }
    public function update($id, Request $request){
        DB::beginTransaction();
        try {
            $payload = $this->formatPayload($request);
            $this->vocabularyRepository->update($id, $payload);
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
            $payload = [];
            $voc = $this->vocabularyRepository->create($payload);
            if ($voc->id > 0) {
                $this->updateLanguagePivot($request, $voc, 'languages');
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    private function updateLanguagePivot($request, $vocabulary, $relation){
        $payload = $this->formatPayload($request);
        $vocabulary->{$relation}()->detach([$vocabulary->id, $this->language]);
        $this->vocabularyRepository->createPivot($vocabulary, $relation, $payload);
    }
    private function formatPayload($request){
        $payload = $request->only($this->payload());
        $payload['code'] = Str::slug($payload['code']);
        $payload['language_id'] = $this->language;
        return $payload;
    }
    private function payload(){
        return [
            'name',
            'code',
            'description'
        ];
    }
}
