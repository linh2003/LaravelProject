<?php
namespace App\Services;
use App\Services\BaseService;
use App\Services\Interfaces\PostServiceInterface;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Repositories\Interfaces\PostCatRepositoryInterface as PostCatRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Classes\Nestedsetbie;
use Illuminate\Support\Str;

class PostService extends BaseService implements PostServiceInterface
{
	protected $postRepository;
    protected $postCatRepository;
    protected $nestedset;
    public function __construct(PostRepository $postRepository, PostCatRepository $postCatRepository){
        $this->postRepository = $postRepository;
        $this->postCatRepository = $postCatRepository;
        $this->nestedset = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' => $this->currentLanguage(),
        ]);
    }

    public function changeStatusAll($post=[]){
        DB::beginTransaction();
        try {
            $payload[$post['field']] = $post['val'];
            $ids = $post['modelId'];
            $flag = $this->postRepository->updateByWhereIn('id',$ids,$payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function changeStatus($post=[]){
        DB::beginTransaction();
        try {
            $payload[$post['field']] = ($post['val']=='1')?'2':'1';
            // dd($payload);
            $id = $post['modelId'];
            $posts = $this->postRepository->update($id,$payload);
            // dd($user);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }

    public function getPostsPagination(Request $request,$pagination=true){
        $condition['keyword'] = addslashes($request->input('post_keyword'));
        if($request->integer('publish')){
            $condition['publish'] = $request->integer('publish');
        }
        $condition['where'] = [
            ['tb2.language_id','=',$this->currentLanguage()],
            // ['tb3.post_catalogue_id','=',$request->input('post_catalogue_id')],
        ];
        $perPage = $request->integer('perpage');
        if(!$request->integer('perpage')){
            $perPage = 20;
        }
        $post = $this->postRepository->getDataPagination(
            $this->selected(),
            $condition,
            [
                ['post_languages as tb2','tb2.post_id','=','posts.id'],
                ['post_catalogue_post as tb3','posts.id','=','tb3.post_id'],
            ],
            $perPage,
            ['path'=>'admin/post','groupBy'=>$this->selected()],
            ['post_catalogues'],
            $this->whereRaw($request),
            $pagination,
            ['posts.id','DESC']
        );
        // dd($postCat);
        return $post;
    }

    public function create(Request $request){
        DB::beginTransaction();
        try {
            $post = $this->createPost($request);
            if ($post->id > 0) {
                $this->updateLanguageForPost($post,$request);
                $this->updateCatalogueForPost($post,$request);
            }

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
            $post = $this->postRepository->findByID($id);
            $flag = $this->uploadPost($id,$request);
            if ($flag) {
                $this->updateLanguageForPost($post,$request);
                $this->updateCatalogueForPost($post,$request);
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
            $user = $this->postRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    private function whereRaw($request)
    {
        $rawCondition = [];
        if ($request->integer('post_catalogue_id') > 0) {
            $rawCondition['whereRaw'] = [
                [
                    'tb3.post_catalogue_id IN (
                        SELECT id
                        FROM post_catalogues
                        WHERE lft >= (SELECT lft FROM post_catalogues as pc WHERE pc.id=?)
                        AND rgt <= (SELECT rgt FROM post_catalogues as pc WHERE pc.id=?)
                    )',
                    [$request->integer('post_catalogue_id'),$request->integer('post_catalogue_id')]
                ]
            ];
        }
        return $rawCondition;
    }
    private function createPost($request)
    {
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        $payload['album'] = $this->formatAlbum($payload);
        $post = $this->postRepository->create($payload);
        return $post;
    }
    private function uploadPost($id,$request)
    {
        $payload = $request->only($this->payload());
        $payload['album'] = $this->formatAlbum($payload);
        return $this->postRepository->update($id,$payload);
    }
    private function updateLanguageForPost($post,$request)
    {
        $payload = $request->only($this->payloadLanguage());
        $payload = $this->formatLanguagePayload($payload,$post->id);

        $post->languages()->detach([$payload['language_id'],$post->id]);

        return $this->postRepository->createPivot($post,$payload,'languages');
    }
    private function updateCatalogueForPost($post,$request)
    {
        $post->post_catalogues()->sync($this->catalogue($request));
    }
    private function formatLanguagePayload($payload,$postId)
    {
        $payload['canonical'] = Str::slug($payload['canonical']);
        $payload['language_id'] = $this->currentLanguage();
        $payload['post_id'] = $postId;
        return $payload;
    }
    private function formatAlbum($payload)
    {
        return (isset($payload['album']) && !empty($payload['album'])) ? json_encode($payload['album']) : '';
    }
    private function catalogue($request)
    {
        $arg = $request->input('catalogue');
        if (!$arg) {
            $arg = [];
        }
        return array_unique(array_merge($arg,[$request->post_catalogue_id]));
    }
    private function payload()
    {
        return ['post_catalogue_id','publish','thumbnail','icon','album'];
    }
    private function payloadLanguage()
    {
        return ['name','canonical','description','content','meta_title','meta_keyword','meta_desc'];
    }
    private function selected()
    {
        return [
            'posts.id',
            'posts.publish',
            'posts.order',
            'posts.thumbnail',
            'posts.album',
            'tb2.name',
            'tb2.canonical',
        ];
    }
}