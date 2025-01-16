<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\UserRoleController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\AttributeTypeController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductCatalogueController;
use App\Http\Controllers\Ajax\AjaxController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\LoginMiddleware;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin',[AuthController::class,'index'])->name('auth.admin')->middleware('login');
Route::post('login',[AuthController::class,'login'])->name('auth.login');

Route::get('logout',[AuthController::class,'logout'])->name('auth.logout');

Route::middleware(['admin','locale'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::get('/dashboard',[BackendController::class,'index'])->name('admin.dashboard');
        /* USER */
        Route::prefix('user')->group(function(){
            Route::get('user',[UserController::class,'index'])->name('admin.user');
            Route::get('create',[UserController::class,'create'])->name('admin.user.create');
            Route::post('store',[UserController::class,'store'])->name('admin.user.store');
            Route::get('{id}/edit',[UserController::class,'edit'])->where('id','[0-9]+')->name('admin.user.edit');
            Route::post('{id}/update',[UserController::class,'update'])->where('id','[0-9]+')->name('admin.user.update');
            Route::get('{id}/delete',[UserController::class,'delete'])->where('id','[0-9]+')->name('admin.user.delete');
            Route::post('{id}/destroy',[UserController::class,'destroy'])->where('id','[0-9]+')->name('admin.user.destroy');
            Route::post('changerole',[UserController::class,'changeRole'])->name('admin.user.changerole');
            /* ROLE */
            Route::prefix('role')->group(function(){
                Route::get('/',[UserRoleController::class,'index'])->name('user.role');
                Route::get('create',[UserRoleController::class,'create'])->name('user.role.create');
                Route::post('store',[UserRoleController::class,'store'])->name('user.role.store');
                Route::get('{id}/edit',[UserRoleController::class,'edit'])->where('id','[0-9]+')->name('user.role.edit');
                Route::post('{id}/update',[UserRoleController::class,'update'])->where('id','[0-9]+')->name('user.role.update');
                Route::get('{id}/delete',[UserRoleController::class,'delete'])->where('id','[0-9]+')->name('user.role.delete');
                Route::post('{id}/destroy',[UserRoleController::class,'destroy'])->where('id','[0-9]+')->name('user.role.destroy');
            });
            /* PERMISSION */
            Route::prefix('permission')->group(function(){
                Route::get('/',[PermissionController::class,'index'])->name('user.permission');
                Route::get('create',[PermissionController::class,'create'])->name('user.permission.create');
                Route::post('store',[PermissionController::class,'store'])->name('user.permission.store');
                Route::get('{id}/edit',[PermissionController::class,'edit'])->where('id','[0-9]+')->name('user.permission.edit');
                Route::post('{id}/update',[PermissionController::class,'update'])->where('id','[0-9]+')->name('user.permission.update');
                Route::get('{id}/delete',[PermissionController::class,'delete'])->where('id','[0-9]+')->name('user.permission.delete');
                Route::post('{id}/destroy',[PermissionController::class,'destroy'])->where('id','[0-9]+')->name('user.permission.destroy');
                Route::post('role',[PermissionController::class,'rolePermission'])->where('id','[0-9]+')->name('user.permission.role');
            });
        });
        /* PRODUCT */
        Route::prefix('product')->group(function(){
            Route::get('/',[ProductController::class,'index'])->name('admin.product');
            Route::get('create',[ProductController::class,'create'])->name('admin.product.create');
            Route::post('store',[ProductController::class,'store'])->name('admin.product.store');
            Route::get('{id}/edit',[ProductController::class,'edit'])->where('id','[0-9]+')->name('admin.product.edit');
            Route::post('{id}/update',[ProductController::class,'update'])->where('id','[0-9]+')->name('admin.product.update');
            Route::get('{id}/delete',[ProductController::class,'delete'])->where('id','[0-9]+')->name('admin.product.delete');
            Route::post('{id}/destroy',[ProductController::class,'destroy'])->where('id','[0-9]+')->name('admin.product.destroy');
            /* ATTRIBUTE TYPE */
            Route::prefix('attype')->group(function(){
                Route::get('/',[AttributeTypeController::class,'index'])->name('product.attype');
                Route::get('create',[AttributeTypeController::class,'create'])->name('product.attype.create');
                Route::post('store',[AttributeTypeController::class,'store'])->name('product.attype.store');
                Route::get('{id}/edit',[AttributeTypeController::class,'edit'])->where('id','[0-9]+')->name('product.attype.edit');
                Route::post('{id}/update',[AttributeTypeController::class,'update'])->where('id','[0-9]+')->name('product.attype.update');
                Route::post('{id}/destroy',[AttributeTypeController::class,'destroy'])->where('id','[0-9]+')->name('product.attype.destroy');
            });
            /* ATTRIBUTE */
            Route::prefix('attribute')->group(function(){
                Route::get('/',[AttributeController::class,'index'])->name('product.attribute');
                Route::get('create',[AttributeController::class,'create'])->name('product.attribute.create');
                Route::post('store',[AttributeController::class,'store'])->name('product.attribute.store');
                Route::get('{id}/edit',[AttributeController::class,'edit'])->where('id','[0-9]+')->name('product.attribute.edit');
                Route::post('{id}/update',[AttributeController::class,'update'])->where('id','[0-9]+')->name('product.attribute.update');
                Route::post('{id}/destroy',[AttributeController::class,'destroy'])->where('id','[0-9]+')->name('product.attribute.destroy');
            });
            /* CATALOGUE */
            Route::prefix('catalogue')->group(function(){
                Route::get('/',[ProductCatalogueController::class,'index'])->name('product.catalogue');
                Route::get('create',[ProductCatalogueController::class,'create'])->name('product.catalogue.create');
                Route::post('store',[ProductCatalogueController::class,'store'])->name('product.catalogue.store');
                Route::get('{id}/edit',[ProductCatalogueController::class,'edit'])->where('id','[0-9]+')->name('product.catalogue.edit');
                Route::post('{id}/update',[ProductCatalogueController::class,'update'])->where('id','[0-9]+')->name('product.catalogue.update');
                Route::post('{id}/destroy',[ProductCatalogueController::class,'destroy'])->where('id','[0-9]+')->name('product.catalogue.destroy');
            });
        });
        /* CONFIGURATION */
        Route::prefix('configuration')->group(function(){
            Route::prefix('language')->group(function(){
                Route::get('/language',[LanguageController::class,'index'])->name('admin.language');
                Route::get('create',[LanguageController::class,'create'])->name('admin.language.create');
                Route::post('store',[LanguageController::class,'store'])->name('admin.language.store');
                Route::get('{id}/edit',[LanguageController::class,'edit'])->where('id','[0-9]+')->name('admin.language.edit');
                Route::get('{id}/delete',[LanguageController::class,'delete'])->where('id','[0-9]+')->name('admin.language.delete');
                Route::get('{id}/switch',[LanguageController::class,'switchLanguage'])->where('id','[0-9]+')->name('language.switch');
            });
        });
    });
    Route::prefix('ajax')->group(function(){
        Route::post('changestatus',[AjaxController::class,'changeStatus'])->name('ajax.changesatatus');
        Route::post('changestatusall',[AjaxController::class,'changeStatusAll'])->name('ajax.changesatatusall');
        Route::get('attribute/getattribute',[AjaxController::class,'getAttribute'])->name('ajax.getattribute');
        Route::get('attribute/loadAttribute',[AjaxController::class,'loadAttribute'])->name('ajax.loadattribute');
    });
});


