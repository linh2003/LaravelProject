<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class ProductCatalogue extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;

    protected $fillable = [
        'parentid',
        'lft',
        'rgt',
        'level',
        'icon',
        'image',
        'album',
        'publish',
        'order',
        'follow',
        'user_id',
    ];
    protected $table = 'product_catalogues';
    public function languages()
    {
        return $this->belongsToMany(Language::class,'product_catalogue_languages','product_catalogue_id', 'language_id')
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
    public function product_catalogue_languages()
    {
        return $this->hasMany(ProductCatalogueLanguage::class,'product_catalogue_id','id');
    }
    public function products(){
        return $this->hasMany(Product::class,'product_catalogue_id','id');
    }
    public static function hasNodeChild($id)
    {
        $productCatalogue = ProductCatalogue::find($id);
        if ($productCatalogue->rgt - $productCatalogue->lft > 1) {
            return true;
        }
        return false;
    }
}
