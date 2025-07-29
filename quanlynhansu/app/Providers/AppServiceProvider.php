<?php

namespace App\Providers;

use App\Http\ViewComposers\LanguageComposer;
use App\Http\ViewComposers\NavComposer;
use App\Http\ViewComposers\SystemComposer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        'App\Services\Interfaces\ModuleServiceInterface' => 'App\Services\ModuleService',
        'App\Repositories\Interfaces\ModuleRepositoryInterface' => 'App\Repositories\ModuleRepository',
        
        'App\Repositories\Interfaces\WardRepositoryInterface' => 'App\Repositories\WardRepository',
        'App\Repositories\Interfaces\DistrictRepositoryInterface' => 'App\Repositories\DistrictRepository',
        'App\Repositories\Interfaces\ProvinceRepositoryInterface' => 'App\Repositories\ProvinceRepository',

        'App\Repositories\Interfaces\SystemRepositoryInterface' => 'App\Repositories\SystemRepository',
        'App\Services\Interfaces\SystemServiceInterface' => 'App\Services\SystemService',

        'App\Services\Interfaces\MenuServiceInterface' => 'App\Services\MenuService',
        'App\Repositories\Interfaces\MenuRepositoryInterface' => 'App\Repositories\MenuRepository',

        'App\Services\Interfaces\MenuCatalogueServiceInterface' => 'App\Services\MenuCatalogueService',
        'App\Repositories\Interfaces\MenuCatalogueRepositoryInterface' => 'App\Repositories\MenuCatalogueRepository',

        'App\Repositories\Interfaces\PermissionRepositoryInterface' => 'App\Repositories\PermissionRepository',
        'App\Services\Interfaces\PermissionServiceInterface' => 'App\Services\PermissionService',

        'App\Repositories\Interfaces\RoleRepositoryInterface' => 'App\Repositories\RoleRepository',
        'App\Services\Interfaces\RoleServiceInterface' => 'App\Services\RoleService',

        'App\Repositories\Interfaces\LanguageRepositoryInterface' => 'App\Repositories\LanguageRepository',
        'App\Services\Interfaces\LanguageServiceInterface' => 'App\Services\LanguageService',

        'App\Repositories\Interfaces\UserRepositoryInterface' => 'App\Repositories\UserRepository',
        'App\Services\Interfaces\UserServiceInterface' => 'App\Services\UserService',
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->bindings as $key => $value) {
            $this->app->bind($key, $value);
        }
        Sanctum::getAccessTokenFromRequestUsing(function($request){
            return $request->cookie('backend_token');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer(['main.layout'], function($view){
            $composerClass = [
                LanguageComposer::class,
                NavComposer::class,
            ];
            foreach ($composerClass as $key => $item) {
                $composer = app()->make($item);
                $composer->compose($view);
            }
        });
    }
}
