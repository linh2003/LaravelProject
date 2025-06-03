<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, QueryScopes, SoftDeletes;
    protected $fillable = [
        'product_catalogue_id',
        'image',
        'album',
        'code',
        'quantity',
        'price',
        'publish',
        'follow',
        'attribute_type',
        'attribute',
        'variant',
        'user_id',
    ];
    public function product_catalogues(){
        return $this->belongsToMany(ProductCatalogue::class, 'product_catalogue_product', 'product_id', 'product_catalogue_id');
    }
    public function languages(){
        return $this->belongsToMany(Language::class, 'product_language', 'product_id', 'language_id')->withPivot(
            'name',
            'description',
            'content',
            'meta_title',
            'meta_description',
            'meta_keyword',
            'canonical',
        )->withTimestamps();
    }
    public function product_variants(){
        return $this->hasMany(ProductVariant::class, 'product_id', 'id');
    }
}
