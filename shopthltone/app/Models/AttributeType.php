<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeType extends Model
{
    use HasFactory, QueryScopes, SoftDeletes;

    protected $fillable = [
        'publish',
        'follow',
        'order',
        'user_id',
    ];
    public function languages(){
        return $this->belongsToMany(Language::class, 'attribute_type_language', 'attribute_type_id', 'language_id')->withPivot(
            'name',
            'description',
            'content',
            'meta_title',
            'meta_description',
            'meta_keyword',
            'canonical',
        );
    }
    public function attributes(){
        return $this->belongsToMany(Attribute::class, 'attribute_type_attribute', 'attribute_type_id', 'attribute_id');
    }
    public function attribute_type_language(){
        return $this->hasMany(AttributeTypeLanguage::class, 'attribute_type_id', 'id');
    }
    public function language($locale = null){
        $locale = $locale ?? app()->getLocale();
        return $this->languages->firstWhere('canonical', $locale);
    }
}
