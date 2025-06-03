<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;

class Promotion extends Model
{
    use HasFactory, QueryScopes;
    protected $fillable = [
        'name',
        'code',
        'type',
        'description',
        'discount',
        'discount_value',
        'discount_type',
        'status',
        'start',
        'end',
    ];
    protected $casts = [
        'discount' => 'json'
    ];
    public function products(){
        return $this->belongsToMany(Product::class, 'promotion_module', 'promotion_id', 'module_id')->withPivot(
            'module'
        );
    }
}
