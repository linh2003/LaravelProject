<?php
namespace App\Repositories;

use App\Models\PostCatalogue;
use App\Repositories\Interfaces\PostCatRepositoryInterface;
use App\Repositories\BaseRepository;

class PostCatRepository extends BaseRepository implements PostCatRepositoryInterface
{
    public function __construct(PostCatalogue $postcat){
        $this->model = $postcat;
    }
    public function getPostCatalogueById(int $id=0, int $language_id=0)
    {
        return $this->model->select(
            [
                'post_catalogues.id',
                'post_catalogues.parentid',
                'post_catalogues.thumbnail',
                'post_catalogues.image',
                'post_catalogues.album',
                'post_catalogues.publish',
                'tb2.name',
                'tb2.description',
                'tb2.canonical',
                'tb2.content',
                'tb2.meta_title',
                'tb2.meta_keyword',
                'tb2.meta_desc',
            ]
        )->join('post_catalogue_languages as tb2','tb2.post_catalogue_id','=','post_catalogues.id')
        ->where('tb2.language_id','=',$language_id)
        ->findOrFail($id);
    }
}