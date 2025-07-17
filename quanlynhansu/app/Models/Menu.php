<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'parent_id',
        'menu_catalogue_id',
        'lft',
        'rgt',
        'level',
        'type',
        'image',
        'icon',
        'publish',
        'order',
        'user_id',
    ];
    public function languages(){
        return $this->belongsToMany(Language::class, 'menu_language', 'menu_id', 'language_id')->withPivot(
            'name',
            'canonical'
        )->withTimestamps();
    }
    public function roles(){
        return $this->belongsToMany(Role::class, 'menu_role', 'menu_id', 'role_id');
    }
}
