<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'canonical',
        'description',
        'module_id',
    ];
    public function roles(){
        return $this->belongsToMany(Role::class, 'role_permission', 'permission_id', 'role_id');
    }
}
