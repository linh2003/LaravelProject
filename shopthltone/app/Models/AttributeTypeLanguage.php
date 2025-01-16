<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeTypeLanguage extends Model
{
    use HasFactory;
    protected $table = 'attribute_type_languages';
    public function attribute_types()
    {
        return $this->belongsTo(AttributeType::class,'attribute_type_id','id');
    }
}
