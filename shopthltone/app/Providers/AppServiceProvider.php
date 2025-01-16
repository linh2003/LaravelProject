<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    protected $servicesProvider = [
        'App\Services\Interfaces\UserServiceInterface' => 'App\Services\UserService',

        'App\Services\Interfaces\UserRoleServiceInterface' => 'App\Services\UserRoleService',

        'App\Services\Interfaces\LanguageServiceInterface' => 'App\Services\LanguageService',

        'App\Services\Interfaces\PostCatServiceInterface' => 'App\Services\PostCatService',

        'App\Services\Interfaces\PostServiceInterface' => 'App\Services\PostService',

        'App\Repositories\Interfaces\UserRepositoryInterface' => 'App\Repositories\UserRepository',

        'App\Repositories\Interfaces\UserRoleRepositoryInterface' => 'App\Repositories\UserRoleRepository',

        'App\Repositories\Interfaces\LanguageRepositoryInterface' => 'App\Repositories\LanguageRepository',

        'App\Repositories\Interfaces\PostCatRepositoryInterface' => 'App\Repositories\PostCatRepository',
        
        'App\Repositories\Interfaces\PostRepositoryInterface' => 'App\Repositories\PostRepository',

        'App\Repositories\Interfaces\RouterRepositoryInterface' => 'App\Repositories\RouterRepository',
    ];
    public function register(): void
    {
        foreach ($this->servicesProvider as $key => $value) {
            $this->app->bind($key,$value);
        }
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
