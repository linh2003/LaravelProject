<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'code',
        'quantity',
        'sku',
        'price',
        'barcode',
        'file',
        'path',
        'album',
        'publish',
        'user_id'
    ];
    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function languages()
    {
        return $this->belongsToMany(Language::class,'product_variant_language','product_variant_id',relatedPivotKey: 'language_id')
        ->withPivot(
            'name'
        )->withTimestamps();
    }
    public function attributes(){
        return $this->belongsToMany(Attribute::class,'product_variant_attribute','product_variant_id',relatedPivotKey: 'attribute_id');
    }
}
