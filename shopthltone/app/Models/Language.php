<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;

class Language extends Model
{
    use HasFactory, QueryScopes;
    protected $fillable = [
        'name',
        'canonical',
        'image',
        'user_id'
    ];
}
