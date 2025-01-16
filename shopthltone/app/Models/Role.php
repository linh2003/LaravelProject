<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;
    protected $fillable = [
        'name',
        'slug',
        'description'
    ];
    protected $table = 'roles';
    public function permissions(){
        return $this->belongsToMany(Permission::class,'role_permission','role_id','permission_id');
    }
    public function users(){
        return $this->belongsToMany(User::class,'user_role','role_id','user_id');
    }
}
