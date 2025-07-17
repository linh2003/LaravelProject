<?php
namespace App\Services;

use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use App\Services\Interfaces\LanguageServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LanguageService implements LanguageServiceInterface
{
    protected $languageRepository;
    public function __construct(LanguageRepository $languageRepository)
    {
        /** @var \App\Repositories\Interfaces\BaseRepositoryInterface */
        $this->languageRepository = $languageRepository;
    }

    public function switchLanguage($id){
        DB::beginTransaction();
        try {
            $payload = ['active' => 1];
            $condition = [['id','=',$id]];
            $this->languageRepository->updateCondition($condition, $payload);
            $payload = ['active' => 0];
            $condition = [['id','!=',$id]];
            $this->languageRepository->updateCondition($condition, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage(); die();
            return false;
        }
    }

    public function create(Request $request){
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token']);
            $payload['user_id'] = Auth::id();
            $this->languageRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
        
    }
    public function getLanguages(Request $request){
        $columns = $this->selectColumn();
        $pagination = config('apps.language');
        $languages = $this->languageRepository->getDataPagination(
            $columns,
            $pagination['pagination'][0]
        );
        return $languages;
    }
    private function selectColumn(){
        return [
            'id',
            'name',
            'canonical',
            'image',
            'active',
        ];
    }
}
