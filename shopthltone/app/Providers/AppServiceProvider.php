<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $servicesProvider = [
        'App\Services\Interfaces\LanguageServiceInterface' => 'App\Services\LanguageService',
        'App\Repositories\Interfaces\LanguageRepositoryInterface' => 'App\Repositories\LanguageRepository',

        'App\Services\Interfaces\UserServiceInterface' => 'App\Services\UserService',
        'App\Repositories\Interfaces\UserRepositoryInterface' => 'App\Repositories\UserRepository',

        'App\Services\Interfaces\UserRoleServiceInterface' => 'App\Services\UserRoleService',
        'App\Repositories\Interfaces\UserRoleRepositoryInterface' => 'App\Repositories\UserRoleRepository',

        'App\Services\Interfaces\PermissionServiceInterface' => 'App\Services\PermissionService',
        'App\Repositories\Interfaces\PermissionRepositoryInterface' => 'App\Repositories\PermissionRepository',

        'App\Services\Interfaces\AttributeTypeServiceInterface' => 'App\Services\AttributeTypeService',
        'App\Repositories\Interfaces\AttributeTypeRepositoryInterface' => 'App\Repositories\AttributeTypeRepository',

        'App\Services\Interfaces\AttributeServiceInterface' => 'App\Services\AttributeService',
        'App\Repositories\Interfaces\AttributeRepositoryInterface' => 'App\Repositories\AttributeRepository',

        'App\Services\Interfaces\ProductCatServiceInterface' => 'App\Services\ProductCatService',
        'App\Repositories\Interfaces\ProductCatRepositoryInterface' => 'App\Repositories\ProductCatRepository',

        'App\Services\Interfaces\ProductServiceInterface' => 'App\Services\ProductService',
        'App\Repositories\Interfaces\ProductRepositoryInterface' => 'App\Repositories\ProductRepository',

        // 'App\Services\Interfaces\ProductVariantLanguageServiceInterface' => 'App\Services\ProductVariantLanguageService',
        'App\Repositories\Interfaces\ProductVariantLanguageRepositoryInterface' => 'App\Repositories\ProductVariantLanguageRepository',

        // 'App\Services\Interfaces\ProductVariantAttributeServiceInterface' => 'App\Services\ProductVariantAttributeService',
        'App\Repositories\Interfaces\ProductVariantAttributeRepositoryInterface' => 'App\Repositories\ProductVariantAttributeRepository',

        // 'App\Services\Interfaces\RouterServiceInterface' => 'App\Services\RouterService',
        'App\Repositories\Interfaces\RouterRepositoryInterface' => 'App\Repositories\RouterRepository',

    ];
    /**
     * Register any application services.
     */
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
