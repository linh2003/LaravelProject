<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\QueryScopes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, QueryScopes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'image',
        'status',
        'password',
        'birthday',
        'province_id',
        'district_id',
        'ward_id',
        'salary',
        'bonus',
        'gender',
        'day_off_number',
        'day_of_join',
        'day_of_leave',
        'cccd',
        'bhxh',
        'social'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'social' => 'json'
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_role','user_id', 'role_id');
    }
    public function hasPermission($permissionCanonical){
        return $this->roles->permissions->contains('canonical', $permissionCanonical);
    }
}
