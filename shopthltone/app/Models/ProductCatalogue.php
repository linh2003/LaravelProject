<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCatalogue extends Model
{
    use HasFactory, QueryScopes, SoftDeletes;
    protected $fillable = [
        'parentid',
        'lft',
        'rgt',
        'image',
        'album',
        'level',
        'icon',
        'publish',
        'follow',
        'order',
        'user_id',
    ];
    public function languages(){
        return $this->belongsToMany(Language::class, 'product_catalogue_language', 'product_catalogue_id', 'language_id')->withPivot(
            'name',
            'description',
            'content',
            'meta_title',
            'meta_desc',
            'meta_keyword',
            'canonical',
        );
    }
    public function products(){
        return $this->belongsToMany(Product::class, 'product_catalogue_product', 'product_catalogue_id', 'product_id');
    }
    public function product_catalogue_language(){
        return $this->hasMany(ProductCatalogueLanguage::class, 'product_catalogue_id', 'id');
    }
}
