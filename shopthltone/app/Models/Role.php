<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;

class Role extends Model
{
    use HasFactory, QueryScopes;
    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id');
    }
    public function permissions(){
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }
}
