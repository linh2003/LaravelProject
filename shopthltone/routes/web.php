<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthLogin;
use App\Http\Controllers\Backend\Ajax\AjaxController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\SystemController;
use App\Http\Controllers\Backend\User\PermissionController;
use App\Http\Controllers\Backend\User\UserController;
use App\Http\Controllers\Backend\User\RoleController;
use App\Http\Controllers\Backend\Product\AttributeController;
use App\Http\Controllers\Backend\Product\AttributeTypeController;
use App\Http\Controllers\Backend\Product\ProductCatalogueController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\PromotionController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\RouterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/* FRONTEND ROUTER */
Route::middleware(['locale'])->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('{canonical}'.config('apps.general.suffix'), [RouterController::class, 'index'])->where('canonical', '[a-zA-Z0-9-]+')->name('router');
    Route::get('{canonical}/trang-{page}'.config('apps.general.suffix'), [RouterController::class, 'page'])->name('router.page')->where('canonical', '[a-zA-Z0-9-]+')->where('page', '[0-9]+');
});

/* BACKEND ROUTER */

/* ADMIN AUTH */
Route::get('admin', [AuthLogin::class, 'login'])->name('admin.login')->middleware('login');
Route::get('logout', [AuthLogin::class, 'logout'])->name('logout');
Route::post('login', [AuthLogin::class, 'auth'])->name('admin.auth');
Route::get('ajax/product/sendAttribute', [AjaxController::class, 'sendAttribute'])->name('ajax.sendAttribute');
/* ADMIN */
Route::middleware(['admin', 'locale'])->group(function(){
    /* AJAX */
    Route::post('ajax/listdata/changestatus', [AjaxController::class, 'changeStatus'])->name('ajax.changestatus');
    Route::post('ajax/listdata/changestatusAll', [AjaxController::class, 'changestatusAll'])->name('ajax.changestatusall');
    Route::get('ajax/admin/getAttrByAttrType', [AjaxController::class, 'getAttrByAttrType'])->name('ajax.getAttrByAttrType');
    Route::get('ajax/admin/loadAttrVariant', [AjaxController::class, 'loadAttrVariant'])->name('ajax.loadAttrVariant');
    Route::get('ajax/promotion/getProduct', [AjaxController::class, 'getProduct'])->name('ajax.getProduct');
    /* ADMIN GROUP */
    Route::prefix('admin')->group(function(){
        /* PROMOTION */
        Route::prefix('promotion')->group(function(){
            Route::prefix('promotion')->group(function(){
                Route::get('/', [PromotionController::class, 'index'])->name('admin.promotion');
                Route::get('create', [PromotionController::class, 'create'])->name('admin.promotion.create');
                Route::post('store', [PromotionController::class, 'store'])->name('admin.promotion.store');
                Route::get('{id}/edit', [PromotionController::class, 'edit'])->where('id', '[0-9]+')->name('admin.promotion.edit');
                Route::post('{id}/update', [PromotionController::class, 'update'])->where('id', '[0-9]+')->name('admin.promotion.update');
                Route::post('{id}/delete', [PromotionController::class, 'remove'])->where('id', '[0-9]+')->name('admin.promotion.delete');
            });
        });
        /* PRODUCT */
        Route::prefix('product')->group(function(){
            Route::prefix('product')->group(function(){
                Route::get('/', [ProductController::class, 'index'])->name('admin.product');
                Route::get('create', [ProductController::class, 'create'])->name('admin.product.create');
                Route::post('store', [ProductController::class, 'store'])->name('admin.product.store');
                Route::get('{id}/edit', [ProductController::class, 'edit'])->where('id', '[0-9]+')->name('admin.product.edit');
                Route::post('{id}/update', [ProductController::class, 'update'])->where('id', '[0-9]+')->name('admin.product.update');
                Route::post('{id}/delete', [ProductController::class, 'remove'])->where('id', '[0-9]+')->name('admin.product.delete');
                Route::post('deleteAll', [ProductController::class, 'deleteAll'])->name('admin.product.deleteall');
            });
            /* PRODUCT CATALOGUE */
            Route::prefix('catalogue')->group(function(){
                // Route::get('/', [ProductCatalogueController::class, 'index'])->name('product.catalogue');
                Route::get('create', [ProductCatalogueController::class, 'create'])->name('product.catalogue.create');
                Route::post('store', [ProductCatalogueController::class, 'store'])->name('product.catalogue.store');
                Route::get('{id}/edit', [ProductCatalogueController::class, 'edit'])->where('id', '[0-9]+')->name('product.catalogue.edit');
                Route::post('{id}/update', [ProductCatalogueController::class, 'update'])->where('id', '[0-9]+')->name('product.catalogue.update');
                Route::post('{id}/delete', [ProductCatalogueController::class, 'remove'])->where('id', '[0-9]+')->name('product.catalogue.delete');
            });
            /* ATTRIBUTE TYPE */
            Route::prefix('attributetype')->group(function(){
                Route::get('/', [AttributeTypeController::class, 'index'])->name('product.attributetype');
                Route::get('create', [AttributeTypeController::class, 'create'])->name('product.attributetype.create');
                Route::post('store', [AttributeTypeController::class, 'store'])->name('product.attributetype.store');
                Route::get('{id}/edit', [AttributeTypeController::class, 'edit'])->where('id', '[0-9]+')->name('product.attributetype.edit');
                Route::post('{id}/update', [AttributeTypeController::class, 'update'])->where('id', '[0-9]+')->name('product.attributetype.update');
                Route::post('{id}/delete', [AttributeTypeController::class, 'remove'])->where('id', '[0-9]+')->name('product.attributetype.delete');
            });
            /* ATTRIBUTE */
            Route::prefix('attribute')->group(function(){
                Route::get('/', [AttributeController::class, 'index'])->name('product.attribute');
                Route::get('create', [AttributeController::class, 'create'])->name('product.attribute.create');
                Route::post('store', [AttributeController::class, 'store'])->name('product.attribute.store');
                Route::get('{id}/edit', [AttributeController::class, 'edit'])->where('id', '[0-9]+')->name('product.attribute.edit');
                Route::post('{id}/update', [AttributeController::class, 'update'])->where('id', '[0-9]+')->name('product.attribute.update');
                Route::post('{id}/delete', [AttributeController::class, 'remove'])->where('id', '[0-9]+')->name('product.attribute.delete');
                Route::post('deleteall', [AttributeController::class, 'deleteAll'])->name('product.attribute.deleteall');
            });
        });
        /* SYSTEM */
        Route::prefix('configuration')->group(function(){
            Route::prefix('system')->group(function(){
                Route::get('/', [SystemController::class, 'index'])->name('admin.system');
                Route::post('store', [SystemController::class, 'store'])->name('system.store');
                Route::get('{id}/edit', [SystemController::class, 'create'])->where('id', '[0-9]+')->name('system.edit');
                Route::post('{id}/update', [SystemController::class, 'update'])->where('id', '[0-9]+')->name('system.update');
            });
            /* LANGUAGE */
            Route::prefix('language')->group(function(){
                Route::get('/', [LanguageController::class, 'index'])->name('admin.language');
                Route::get('create', [LanguageController::class, 'create'])->name('language.create');
                Route::post('store', [LanguageController::class, 'store'])->name('language.store');
                Route::get('{id}/edit', [LanguageController::class, 'create'])->where('id', '[0-9]+')->name('language.edit');
                Route::post('{id}/update', [LanguageController::class, 'update'])->where('id', '[0-9]+')->name('language.update');
                Route::get('{id}/delete', [LanguageController::class, 'create'])->where('id', '[0-9]+')->name('language.delete');
                Route::get('{id}/switch', [LanguageController::class, 'switchLanguage'])->where('id', '[0-9]+')->name('language.switch');
            });
        });
        /* DASHBOARD */
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        /* USER */
        Route::prefix('user')->group(function(){
            Route::get('user', [UserController::class, 'index'])->name('admin.user');
            Route::get('create', [UserController::class, 'create'])->name('user.create');
            Route::get('{id}/edit', [UserController::class, 'create'])->where('id', '[0-9]+')->name('user.edit');
            Route::get('{id}/delete', [UserController::class, 'create'])->where('id', '[0-9]+')->name('user.delete');
            Route::post('changerole', [UserController::class, 'changeRole'])->name('user.changerole');
            /* ROLE */
            Route::prefix('role')->group(function(){
                Route::get('/', [RoleController::class, 'index'])->name('user.role');
                Route::get('create', [RoleController::class, 'create'])->name('role.create');
                Route::post('store', [RoleController::class, 'store'])->name('role.store');
                Route::get('{id}/edit', [RoleController::class, 'create'])->where('id', '[0-9]+')->name('role.edit');
                Route::post('{id}/update', [RoleController::class, 'update'])->where('id', '[0-9]+')->name('role.update');
                Route::get('{id}/delete', [RoleController::class, 'create'])->where('id', '[0-9]+')->name('role.delete');
            });
            /* PERMISSION */
            Route::prefix('permission')->group(function(){
                Route::get('/', [PermissionController::class, 'index'])->name('user.permission');
                Route::get('create', [PermissionController::class, 'create'])->name('permission.create');
                Route::post('store', [PermissionController::class, 'store'])->name('permission.store');
                Route::get('{id}/edit', [PermissionController::class, 'create'])->where('id', '[0-9]+')->name('permission.edit');
                Route::post('{id}/update', [PermissionController::class, 'update'])->where('id', '[0-9]+')->name('permission.update');
                Route::get('{id}/delete', [PermissionController::class, 'create'])->where('id', '[0-9]+')->name('permission.delete');
                Route::post('role', [PermissionController::class, 'rolePermission'])->name('permission.role');
            });
        });
        
    });
});

