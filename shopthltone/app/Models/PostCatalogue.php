<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use App\Traits\QueryScopes;

class PostCatalogue extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;

    protected $fillable = [
        'parentid',
        'lft',
        'rgt',
        'level',
        'thumbnail',
        'image',
        'album',
        'publish',
        'order',
        'user_id',
    ];
    protected $table = 'post_catalogues';
    public function languages()
    {
        return $this->belongsToMany(Language::class,'post_catalogue_languages','post_catalogue_id',relatedPivotKey: 'language_id')
        ->withPivot(
            'name',
            'canonical',
            'meta_title',
            'meta_keyword',
            'meta_desc',
            'description',
            'content',
        )->withTimestamps();
    }
    public function post_catalogue_languages()
    {
        return $this->hasMany(PostCatalogueLanguage::class,'post_catalogue_id','id');
    }
    public function posts(){
        return $this->belongsToMany(Post::class,'post_catalogue_post','post_catalogue_id','post_id');
    }
    public static function hasNodeChild($id)
    {
        $postCatalogue = PostCatalogue::find($id);
        if ($postCatalogue->rgt - $postCatalogue->lft > 1) {
            return true;
        }
        return false;
    }
}
