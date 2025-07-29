<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    public function roles(){
        return $this->belongTo(Role::class, 'role_id', 'id');
    }

    public function permissions(){
        return $this->belongTo(Permission::class, 'permission_id', 'id');
    }
}
