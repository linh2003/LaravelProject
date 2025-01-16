<?php
namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function __construct(Post $post){
        $this->model = $post;
    }
    public function getPostById(int $id=0, int $language_id=0)
    {
        return $this->model->select(
            [
                'posts.id',
                'posts.post_catalogue_id',
                'posts.thumbnail',
                'posts.album',
                'posts.publish',
                'tb2.name',
                'tb2.description',
                'tb2.canonical',
                'tb2.content',
                'tb2.meta_title',
                'tb2.meta_keyword',
                'tb2.meta_desc',
            ]
        )->join('post_languages as tb2','tb2.post_id','=','posts.id')
        
        ->where('tb2.language_id','=',$language_id)
        ->findOrFail($id);
    }
}