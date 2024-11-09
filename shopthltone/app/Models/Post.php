<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use App\Traits\QueryScopes;

class Post extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;

    protected $fillable = [
        'post_catalogue_id',
        'thumbnail',
        'album',
        'icon',
        'publish',
        'order',
        'user_id',
    ];
    protected $table = 'posts';
    public function languages()
    {
        return $this->belongsToMany(Language::class,'post_languages','post_id','language_id')
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
    public function post_catalogues()
    {
        return $this->belongsToMany(PostCatalogue::class,'post_catalogue_post','post_id','post_catalogue_id');
    }
    
}
