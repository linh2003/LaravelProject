<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory, QueryScopes, SoftDeletes;
    protected $fillable = [
        'image',
        'publish',
        'follow',
        'order',
        'user_id',
    ];
    public function languages(){
        return $this->belongsToMany(Language::class, 'attribute_language', 'attribute_id', 'language_id')->withPivot(
            'name',
            'description',
            'content',
            'meta_title',
            'meta_description',
            'meta_keyword',
            'canonical',
        );
    }
    public function attribute_types(){
        return $this->belongsToMany(AttributeType::class, 'attribute_type_attribute', 'attribute_id', 'attribute_type_id');
    }
    public function attribute_language(){
        return $this->hasMany(AttributeLanguage::class, 'attribute_id', 'id');
    }
}
