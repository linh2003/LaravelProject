<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory, QueryScopes;
    protected $fillable = [
        'product_id',
        'album',
        'quantity',
        'price',
        'sku',
        'filename',
        'fileurl',
        'code',
        'publish',
        'user_id',
    ];
    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function attributes(){
        return $this->belongsToMany(Attribute::class, 'product_variant_attribute', 'product_variant_id', 'attribute_id');
    }
    public function languages(){
        return $this->belongsToMany(Language::class, 'product_variant_language', 'product_variant_id', 'language_id')->withPivot('name')->withTimestamps();
    }
}
