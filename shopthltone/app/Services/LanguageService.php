<?php
namespace App\Services;
use App\Services\Interfaces\LanguageServiceInterface;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LanguageService implements LanguageServiceInterface
{
    protected $languageRepository;
    protected $userRepository;
    public function __construct(LanguageRepository $languageRepository){
        $this->languageRepository = $languageRepository;
    }

    public function switchLanguage($id){
        DB::beginTransaction();
        try {
            $condition = [['id','=',$id]];
            $payload = ['active' => 1];
            $this->languageRepository->updateByWhere($condition,$payload);
            $condition = [['id','!=',$id]];
            $payload = ['active' => 0];
            $this->languageRepository->updateByWhere($condition,$payload);
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
            $payload = $request->except(['_token','send']);
            // dd($payload);
            $language = $this->languageRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function getLanguages(Request $request, $pagination=false,$select=['*']){
        $condition = $request->except('search');
        if (isset($condition['keyword'])) {
            $condition['keyword'] = addslashes($condition['keyword']);
        }
        $perPage = isset($condition['perpage']) ? intval($condition['perpage']) : 0;
        return $this->languageRepository->getDataPagination($select,$condition,[],$perPage,['path'=>'admin/language'],[],[],$pagination);
    }
    private function select(){
        return [
            'name',
            'caninocal',
            'image',
            'user_id',
        ];
    }
    
}