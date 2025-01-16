<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeType extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;

    protected $fillable = [
        'parentid',
        'lft',
        'rgt',
        'level',
        'image',
        'icon',
        'album',
        'publish',
        'follow',
        'order',
        'user_id',
    ];
    protected $table = 'attribute_types';
    public function languages()
    {
        return $this->belongsToMany(Language::class,'attribute_type_languages','attribute_type_id',relatedPivotKey: 'language_id')
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
    public function attributes(){
        return $this->belongsToMany(Attribute::class,'attribute_type_attribute','attribute_type_id','attribute_id');
    }
    public function attribute_type_languages(){
        return $this->hasMany(AttributeTypeLanguage::class,'attribute_type_id','id');
    }
}
