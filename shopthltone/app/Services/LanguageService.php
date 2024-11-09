<?php
namespace App\Services;
use App\Services\Interfaces\LanguageServiceInterface;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LanguageService implements LanguageServiceInterface
{
    protected $languageRepository;
    protected $userRepository;
    public function __construct(LanguageRepository $languageRepository, UserRepository $userRepository){
        $this->languageRepository = $languageRepository;
        $this->userRepository = $userRepository;
    }

    public function getAllUser(){
        $users = $this->userRepository->getAll(['DESC','id']);
        return $users;
    }

    public function getLanguagePagination(Request $request,$pagination=true){
        // echo __METHOD__; die();
        $condition['keyword'] = addslashes($request->input('language_keyword'));
        // dd($condition);
        $perPage = $request->integer('perpage');
        if(!$request->integer('perpage')){
            $perPage = 20;
        }
        $language = $this->languageRepository->getDataPagination(
            '*',
            $condition,
            [],
            $perPage,
            ['path'=>'admin/language'],
            [],
            [],
            $pagination
        );
        return $language;
    }

    public function switchLanguage($id){
        DB::beginTransaction();
        try {
            $this->languageRepository->update($id,['current'=>1]);
            $payload = ['current'=>0];
            $where = [['id','!=',$id]];
            $this->languageRepository->updateByWhere(
            $where,
            $payload
            );
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
    public function update($id,Request $req){
        DB::beginTransaction();
        try {
            $payload = $req->except(['_token','send']);
            // dd($payload);
            $language = $this->languageRepository->update($id,$payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function destroy($id){
        DB::beginTransaction();
        try {
            $user = $this->languageRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
}