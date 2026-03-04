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
    
    public function storeTranslate($id, $languageId, $model, Request $request) {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token');
            // dd($payload);
            // $foreignKey = strtolower(trim($model)).'_id';
            // $payload[$foreignKey] = $id;
            $payload['language_id'] = $languageId;
            $repoModel = ucfirst(trim($model));
            $repository = 'App\Repositories\\'.$repoModel.'Repository';
            $repoRelation = 'App\Repositories\\'.$repoModel.'LanguageRepository';
            $object = null;
            if (class_exists($repository)) {
                $repositoryInstance = app($repository);
                $method = 'get'.$repoModel.'ById';
                $object = $repositoryInstance->findById($id);
                $relation = $repositoryInstance->{$method}($id, $languageId);
                // dd($object);
                if ($relation == null) {
                    // $object->languages()->detach([$id, $languageId]);
                    $repositoryInstance->createPivot($object, 'languages', $payload);
                }else{
                    $localKey = strtolower(trim($model)).'_id';
                    $condition = [
                        [$localKey, '=', $id],
                        ['language_id', '=', $languageId],
                    ];
                    if (class_exists($repoRelation)) {
                        // dd($repoRelation);
                        $repoRelationInstance = app($repoRelation);
                        $repoRelationInstance->updateCondition($condition, $payload);
                    }
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage(); die();
            return false;
        }
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
