<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\UserRolesController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\PostCatalogueController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Ajax\DashboardController;
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

/* AUTHENTICATED ADMIN */
Route::get('/admin',[AuthController::class,'index'])->name('auth.admin')->middleware(LoginMiddleware::class);
Route::post('/login',[AuthController::class,'login'])->name('auth.login');
Route::get('/admin/logout',[AuthController::class,'logout'])->name('auth.logout');

Route::group(['middleware'=>['admin','locale']],function(){
    Route::get('/admin/dashboard',[BackendController::class,'dashboard'])->name('admin.dashboard');

    Route::group(['prefix'=>'admin/user'],function(){
        Route::get('/',[UserController::class,'index'])->name('admin.user');
        Route::get('create',[UserController::class,'create'])->name('admin.user.create');
        Route::post('store',[UserController::class,'store'])->name('admin.user.store');
        Route::post('{id}/update',[UserController::class,'update'])->where('id', '[0-9]+')->name('admin.user.update');
        Route::get('{id}/edit',[UserController::class,'edit'])->where('id', '[0-9]+')->name('admin.user.edit');
        Route::get('{id}/delete',[UserController::class,'delete'])->where('id', '[0-9]+')->name('admin.user.delete');
        Route::post('{id}/destroy',[UserController::class,'destroy'])->where('id', '[0-9]+')->name('admin.user.destroy');
        Route::post('changerole',[UserController::class,'changeRole'])->name('admin.user.changerole');
        Route::get('selectrole',[UserController::class,'selectRole'])->name('admin.user.selectrole');
        Route::post('applyrole',[UserController::class,'applyRole'])->name('admin.user.applyrole');
        /* USER ROLES */
        Route::group(['prefix'=>'role'],function(){
            Route::get('/',[UserRolesController::class,'index'])->name('user.roles');
            Route::get('create',[UserRolesController::class,'create'])->name('user.role.create');
            Route::post('store',[UserRolesController::class,'store'])->name('user.role.store');
            Route::post('{id}/update',[UserRolesController::class,'update'])->where('id', '[0-9]+')->name('user.role.update');
            Route::get('{id}/edit',[UserRolesController::class,'edit'])->where('id', '[0-9]+')->name('user.role.edit');
            Route::get('{id}/delete',[UserRolesController::class,'delete'])->where('id', '[0-9]+')->name('user.role.delete');
            Route::post('{id}/destroy',[UserRolesController::class,'destroy'])->where('id', '[0-9]+')->name('user.role.destroy');
        });
    });
    /* Config Language */
    Route::group(['prefix'=>'admin/language'],function(){
        Route::get('/',[LanguageController::class,'index'])->name('admin.language');
        Route::get('create',[LanguageController::class,'create'])->name('admin.language.create');
        Route::post('store',[LanguageController::class,'store'])->name('admin.language.store');
        Route::post('{id}/update',[LanguageController::class,'update'])->where('id', '[0-9]+')->name('admin.language.update');
        Route::get('{id}/edit',[LanguageController::class,'edit'])->where('id', '[0-9]+')->name('admin.language.edit');
        Route::get('{id}/delete',[LanguageController::class,'delete'])->where('id', '[0-9]+')->name('admin.language.delete');
        Route::post('{id}/destroy',[LanguageController::class,'destroy'])->where('id', '[0-9]+')->name('admin.language.destroy');
    });
    Route::get('language/{id}/switch',[LanguageController::class,'switchBackendLanguage'])->name('language.switch');
    /* Post Catalogues */
    Route::group(['prefix'=>'admin/post'],function(){
        Route::get('/',[PostController::class,'index'])->name('admin.post');
        Route::get('create',[PostController::class,'create'])->name('admin.post.create');
        Route::post('store',[PostController::class,'store'])->name('admin.post.store');
        Route::post('{id}/update',[PostController::class,'update'])->where('id', '[0-9]+')->name('admin.post.update');
        Route::get('{id}/edit',[PostController::class,'edit'])->where('id', '[0-9]+')->name('admin.post.edit');
        Route::get('{id}/delete',[PostController::class,'delete'])->where('id', '[0-9]+')->name('admin.post.delete');
        Route::post('{id}/destroy',[PostController::class,'destroy'])->where('id', '[0-9]+')->name('admin.post.destroy');
        /* USER ROLES */
        Route::group(['prefix'=>'cat'],function(){
            Route::get('/',[PostCatalogueController::class,'create'])->name('admin.post.cat');
            Route::get('create',[PostCatalogueController::class,'create'])->name('post.cat.create');
            Route::post('store',[PostCatalogueController::class,'store'])->name('post.cat.store');
            Route::post('{id}/update',[PostCatalogueController::class,'update'])->where('id', '[0-9]+')->name('post.cat.update');
            Route::get('{id}/edit',[PostCatalogueController::class,'edit'])->where('id', '[0-9]+')->name('post.cat.edit');
            Route::get('{id}/delete',[PostCatalogueController::class,'delete'])->where('id', '[0-9]+')->name('post.cat.delete');
            Route::post('{id}/destroy',[PostCatalogueController::class,'destroy'])->where('id', '[0-9]+')->name('post.cat.destroy');
        });
    });
    /* Ajax */
    Route::post('ajax/dashboard/changestatus',[DashboardController::class,'changeStatus'])->name('ajax.dashboard.changestatus');
    Route::post('ajax/dashboard/changestatusall',[DashboardController::class,'changeStatusAll'])->name('ajax.dashboard.changestatusall');
});
/* USER MANAGE */
// Route::get('/admin/user',[UserController::class,'index'])->name('admin.user')->middleware(AuthMiddleware::class);







