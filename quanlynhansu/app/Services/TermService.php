<?php
namespace App\Services;

use App\Services\Interfaces\TermServiceInterface;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\TermRepositoryInterface as TermRepository;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use Illuminate\Support\Str;

class TermService extends BaseService implements TermServiceInterface
{
    protected $termRepository;
    protected $languageRepository;
    public function __construct(TermRepository $termRepository, LanguageRepository $languageRepository)
    {
        parent::__construct();
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->termRepository = $termRepository;
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->languageRepository = $languageRepository;
    }
    public function sortTermOrder($order = []){
        return $this->termRepository->updateOrder($order);
    }
    public function getTermByCondition($condition){
        $ret = $this->termRepository->getTermByCondition($condition, $this->language);
        // dd($ret);
        return $ret;
    }
	public function getTermById($id, $select = []){
        $ret = $this->termRepository->getTermById($id, $this->language, $select);
        return $ret;
    }
    public function createMultiple($payload = []){
        $id = $payload['id'];
        $terms = $payload['data'];
        $formatPayload = [
            'vocabulary_id' => $id,
            'publish' => config('apps.general.publish')
        ];
        DB::beginTransaction();
        try {
            foreach ($terms as $it) {
                $term = $this->termRepository->create($formatPayload);
                if ($term->id > 0) {
                    $code = convertUnicode($it);
                    $payloadLang = [
                        'name' => $it,
                        'code' => Str::slug($code),
                        'language_id' => $this->language
                    ];
                    $this->termRepository->createPivot($term, 'languages', $payloadLang);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function getTerm(){
        $terms = $this->termRepository->getAll();
        $language = $this->languageRepository->getAll();
        $data = [];
        foreach ($terms as $k => $term) {
            $i = 0;
            $data[$k][0]['term'] = $this->termRepository->getTermById($term->id, $this->language);
            $data[$k][0]['language'] = $this->language;
            foreach ($language as $key => $lang) {
                if ($lang->id != $this->language) {
                    $i++;
                    $data[$k][$i]['term'] = $this->termRepository->getTermById($term->id, $lang->id);
                    $data[$k][$i]['language'] = $lang->id;
                }
            }
        }
        return $data;
    }
    // public function update($id, Request $request){
    //     DB::beginTransaction();
    //     try {
    //         $payload = $this->formatPayload($request);
    //         $this->termRepository->update($id, $payload);
    //         DB::commit();
    //         return true;
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         echo $e->getMessage();die();
    //         return false;
    //     }
    // }

    public function create(Request $request){
        DB::beginTransaction();
        try {
            $payload = $this->formatPayload($request);
            $term = $this->termRepository->create($payload);
            if ($term->id > 0) {
                $this->updateLanguagePivot($request, $term, 'languages');
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    private function updateLanguagePivot($request, $term, $relation){
		$payloadLang = $this->formatPayloadLanguage($request);
        $term->{$relation}()->detach([$term->id, $this->language]);
        $this->termRepository->createPivot($term, $relation, $payloadLang);
    }
    private function formatPayloadLanguage($request){
		$payloadLang = $request->only($this->payloadLanguage());
		$payloadLang['code'] = Str::slug($payloadLang['code']);
        $payloadLang['language_id'] = $this->language;
		return $payloadLang;
	}
    private function formatPayload($request){
        $payload = $request->only($this->payload());
        
		foreach($payload['meta_key'] as $k => $item){
			$payload['meta'][$item] = $payload['meta_value'][$k];
		}
        return $payload;
    }
    private function payloadLanguage(){
		return [
			'name',
            'code',
			'description',
		];
	}
    private function payload(){
        return [
            'vocabulary_id',
            'publish',
            'meta_key',
            'meta_value',
        ];
    }
}
