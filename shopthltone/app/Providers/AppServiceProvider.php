<?php

namespace App\Providers;

use App\Http\ViewComposers\LanguageComposer;
use App\Http\ViewComposers\ProductCatalogueComposer;
use App\Http\ViewComposers\SystemComposer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        'App\Services\Interfaces\WidgetServiceInterface' => 'App\Services\WidgetService',

        'App\Repositories\Interfaces\SystemRepositoryInterface' => 'App\Repositories\SystemRepository',
        'App\Services\Interfaces\SystemServiceInterface' => 'App\Services\SystemService',

        'App\Repositories\Interfaces\PromotionRepositoryInterface' => 'App\Repositories\PromotionRepository',
        'App\Services\Interfaces\PromotionServiceInterface' => 'App\Services\PromotionService',

        'App\Repositories\Interfaces\ProductRepositoryInterface' => 'App\Repositories\ProductRepository',
        'App\Services\Interfaces\ProductServiceInterface' => 'App\Services\ProductService',

        'App\Repositories\Interfaces\ProductCatalogueRepositoryInterface' => 'App\Repositories\ProductCatalogueRepository',
        'App\Services\Interfaces\ProductCatalogueServiceInterface' => 'App\Services\ProductCatalogueService',

        'App\Repositories\Interfaces\RouterRepositoryInterface' => 'App\Repositories\RouterRepository',
        'App\Repositories\Interfaces\ProductVariantRepositoryInterface' => 'App\Repositories\ProductVariantRepository',
        'App\Repositories\Interfaces\ProductVariantAttributeRepositoryInterface' => 'App\Repositories\ProductVariantAttributeRepository',
        'App\Repositories\Interfaces\ProductVariantLanguageRepositoryInterface' => 'App\Repositories\ProductVariantLanguageRepository',

        'App\Repositories\Interfaces\AttributeRepositoryInterface' => 'App\Repositories\AttributeRepository',
        'App\Services\Interfaces\AttributeServiceInterface' => 'App\Services\AttributeService',

        'App\Repositories\Interfaces\AttributeTypeRepositoryInterface' => 'App\Repositories\AttributeTypeRepository',
        'App\Services\Interfaces\AttributeTypeServiceInterface' => 'App\Services\AttributeTypeService',

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer(['backend.layout'], function($view){
            $composerClass = [
                LanguageComposer::class,
            ];
            foreach ($composerClass as $key => $val) {
                $composer = app()->make($val);
                $composer->compose($view);
            }
        });
        view()->composer(['frontend.layout'], function($view){
            $composerClass = [
                LanguageComposer::class,
                ProductCatalogueComposer::class,
                // SystemComposer::class,
            ];
            foreach ($composerClass as $key => $val) {
                $composer = app()->make($val);
                $composer->compose($view);
            }
        });
    }
}
