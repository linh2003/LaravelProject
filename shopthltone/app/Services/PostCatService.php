<?php
namespace App\Services;
use App\Services\BaseService;
use App\Services\Interfaces\PostCatServiceInterface;
use App\Repositories\Interfaces\PostCatRepositoryInterface as PostCatRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\RouterRepositoryInterface as RouterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Classes\Nestedsetbie;
use Illuminate\Support\Str;

class PostCatService extends BaseService implements PostCatServiceInterface
{
	protected $postCatRepository;
	protected $routerRepository;
    protected $nestedset;
    public function __construct(PostCatRepository $postCatRepository, RouterRepository $routerRepository){
        $this->postCatRepository = $postCatRepository;
        $this->routerRepository = $routerRepository;
        $this->nestedset = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' => $this->currentLanguage(),
        ]);
    }

    public function getAllUser(){
        $users = $this->userRepository->getAll(['DESC','id']);
        return $users;
    }

    public function getPostCatalogues(){
        $postCat = $this->postCatRepository->getDataPagination(
            $this->selected(),
            [],
            [
                ['post_catalogue_languages as tb2','tb2.post_catalogue_id','=','post_catalogues.id']
            ],
            0,
            ['path'=>'admin/post/cat'],
            [],
            [],
            true,
            ['post_catalogues.lft','ASC']
        );
        return $postCat;
    }

    public function create(Request $request){
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload());
            $payload['user_id'] = Auth::id();
            if(isset($payload['album'])){
                $payload['album'] = json_encode($payload['album']);
            }
            $postCat = $this->postCatRepository->create($payload);
            if ($postCat->id > 0) {
                $payloadLanguage = $request->only($this->payloadLanguage());
                $payloadLanguage['canonical'] = Str::slug($payloadLanguage['canonical']);
                $payloadLanguage['language_id'] = $this->currentLanguage();
                $payloadLanguage['post_catalogue_id'] = $postCat->id;
                // dd($payloadLanguage);
                $language = $this->postCatRepository->createPivot($postCat,$payloadLanguage,'languages');
                $router = [
                    'canonical' => $payloadLanguage['canonical'],
                    'module_id' => $postCat->id,
                    'controller' => 'App\Http\Controllers\Frontend\PostCatController',
                ];
                $this->routerRepository->create($router);
            }
            $this->nestedset->Get();
            $this->nestedset->Recursive(0,$this->nestedset->Set());
            $this->nestedset->Action();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function update($id,Request $request){
        DB::beginTransaction();
        try {
            $postCat = $this->postCatRepository->findByID($id);
            $payload = $request->only($this->payload());
            if(isset($payload['album'])){
                $payload['album'] = json_encode($payload['album']);
            }
            $flag = $this->postCatRepository->update($id,$payload);
            // dd($flag);
            if ($flag) {
                $payloadLanguage = $request->only($this->payloadLanguage());
                $payloadLanguage['language_id'] = $this->currentLanguage();
                $payloadLanguage['post_catalogue_id'] = $postCat->id;
                $postCat->languages()->detach([$payloadLanguage['language_id'],$id]);
                $response = $this->postCatRepository->createPivot($postCat,$payloadLanguage,'languages');
                $router = [
                    'canonical' => $payloadLanguage['canonical'],
                    'module_id' => $postCat->id,
                    'controller' => 'App\Http\Controllers\Frontend\PostCatController',
                ];
                $condition = [
                    ['module_id','=',$id],
                    ['controller','=',$router['controller']],
                ];
                $this->routerRepository->updateByWhere($condition,$router);
                $this->nestedset->Get();
                $this->nestedset->Recursive(0,$this->nestedset->Set());
                $this->nestedset->Action();
            }
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
            $user = $this->postCatRepository->delete($id);
            $this->nestedset->Get();
            $this->nestedset->Recursive(0,$this->nestedset->Set());
            $this->nestedset->Action();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    private function payload()
    {
        return ['parentid','publish','thumbnail','image','album'];
    }
    private function payloadLanguage()
    {
        return ['name','canonical','description','content','meta_title','meta_keyword','meta_desc'];
    }
    private function selected()
    {
        return [
            'post_catalogues.id',
            'post_catalogues.lft',
            'post_catalogues.rgt',
            'post_catalogues.level',
            'post_catalogues.publish',
            'post_catalogues.order',
            'post_catalogues.thumbnail',
            'tb2.name',
            'tb2.canonical',
        ];
    }
}