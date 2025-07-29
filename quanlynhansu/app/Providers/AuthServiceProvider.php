<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Enums\Constant;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('modules', function($user, $permissionName){
            if ($user->status == 2) {
                return false;
            }
            if($user->id == Constant::SUPERADMIN) {
                return true;
            }
            $permission = $user->roles->first()->permissions;
            if($permission->contains('canonical', $permissionName)) {
                return true;
            }
            return false;
        });
    }
}
