<?php
namespace App\Services;

use App\Services\Interfaces\LanguageServiceInterface;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use Illuminate\Support\Facades\DB;

class LanguageService implements LanguageServiceInterface
{
    protected $languageRepository;
    public function __construct(LanguageRepository $languageRepository){
        $this->languageRepository = $languageRepository;
    }
    public function switchLanguage($id){
        $modelId = intval($id);
        DB::beginTransaction();
        try {
            $conditionReset = [['id', '!=', $modelId]];
            $value = ['active' => 0];
            $this->languageRepository->updateByCondition( $conditionReset, $value);
            $condition = [['id', '=', $modelId]];
            $payload = ['active' => 1];
            $this->languageRepository->updateByCondition($condition, $payload);
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
            $payload = $request->except(['_token','send']);
            $this->languageRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function getData($request, $counter = false){
        $select = $this->select();
        return $this->languageRepository->getData($select, [], $counter);
    }
    private function select(){
        return [
            'id',
            'name',
            'canonical',
            'image',
            'active'
        ];
    }
}