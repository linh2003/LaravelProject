<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;

    protected $fillable = [
        'attribute_type_id',
        'image',
        'album',
        'icon',
        'publish',
        'follow',
        'order',
        'user_id',
    ];
    protected $table = 'attributes';
    public function languages()
    {
        return $this->belongsToMany(Language::class,'attribute_languages','attribute_id',relatedPivotKey: 'language_id')
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

    public function attribute_types(){
        return $this->belongsToMany(AttributeType::class,'attribute_type_attribute','attribute_id','attribute_type_id');
    }
    public function attribute_languages(){
        return $this->hasMany(AttributeLanguage::class,'attribute_id','id');
    }
    public function product_variants(){
        return $this->belongsToMany(ProductVariant::class,'product_variant_attribute', 'attribute_id', 'product_variant_id');
    }
}
