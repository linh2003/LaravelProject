<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCatalogue extends Model
{
    protected $fillable = [
        'name',
        'keyword',
        'publish'
    ];
}
