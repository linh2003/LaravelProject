<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class Product extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;

    protected $fillable = [
        'image',
        'album',
        'icon',
        'follow',
        'order',
        'product_catalogue_id',
        'publish',
        'user_id',
        'attribute_type'
    ];
    protected $table = 'products';
    public function languages()
    {
        return $this->belongsToMany(Language::class,'product_languages','product_id',relatedPivotKey: 'language_id')
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
    public function product_catalogues(){
        return $this->belongsToMany(ProductCatalogue::class,'product_catalogue_product','product_id','product_catalogue_id');
    }
    public function product_variants(){
        return $this->hasMany(ProductVariant::class,'product_id','id');
    }
}
