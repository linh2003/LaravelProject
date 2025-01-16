<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class Language extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;

    protected $fillable = [
        'name',
        'canonical',
        'image',
        'user_id',
        'active',
    ];
    protected $table = 'languages';
    public function attribute_types()
    {
        return $this->belongsToMany(AttributeType::class,'attribute_type_languages','language_id','attribute_type_id')
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
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class,'attribute_languages','language_id','attribute_id')
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
    public function product_catalogues()
    {
        return $this->belongsToMany(ProductCatalogue::class,'product_catalogue_languages','language_id','product_catalogue_id')
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
    public function products()
    {
        return $this->belongsToMany(Product::class,'product_languages','language_id','product_id')
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
    public function product_variants()
    {
        return $this->belongsToMany(ProductVariant::class,'product_variant_language','language_id','product_variant_id')
        ->withPivot(
            'name'
        )->withTimestamps();
    }
}
