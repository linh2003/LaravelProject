<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'publish',
    ];
    public function permissions(){
        return $this->hasMany(Permission::class, 'module_id', 'id');
    }
}
