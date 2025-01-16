<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;

class Permission extends Model
{
    use HasFactory, QueryScopes;
    protected $fillable = [
        'name',
        'canonical',
        'description'
    ];
    protected $table = 'permissions';
    public function roles(){
        return $this->belongsToMany(Role::class,'role_permission','permission_id','role_id');
    }
}
