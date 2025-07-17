<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'machine_name',
        'description',
    ];
    protected $table = 'roles';

    public function users()
    {
        return $this->belongsToMany(User::class,'user_role', 'role_id', 'user_id');
    }
    public function permissions(){
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }
    public function menus(){
        return $this->belongsToMany(Menu::class, 'menu_role', 'role_id', 'menu_id');
    }
}
