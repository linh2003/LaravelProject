<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\LicenseController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\TaskController;
use App\Http\Controllers\Backend\User\PermissionController;
use App\Http\Controllers\Backend\User\RoleController;
use App\Http\Controllers\Backend\User\UserController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Ajax\AjaxController;
use App\Http\Controllers\Ajax\MenuController as AjaxMenuController;

Route::middleware(['admin','locale'])->group(function(){
    Route::prefix('admin')->group(function(){
        /* LICENSE - ĐƠN XIN PHÉP */
        Route::prefix('license')->group(function(){
            Route::get('/', [LicenseController::class, 'index'])->name('license.view');
        });
        /* TASK */
        Route::prefix('task')->group(function(){
            Route::get('/incomplete', [TaskController::class, 'incomplete'])->name('task.incomplete');
            Route::get('/complete', [TaskController::class, 'complete'])->name('task.complete');
        });
        /* USER */
        Route::prefix('user')->group(function(){
            Route::get('/',[UserController::class,'index'])->name('user.view');
            Route::get('create',[UserController::class,'create'])->name('user.create');
            Route::post('store',[UserController::class,'store'])->name('user.store');
            Route::get('{id}/edit',[UserController::class,'edit'])->where('id','[0-9]+')->name('user.edit');
            Route::post('{id}/update',[UserController::class,'update'])->where('id','[0-9]+')->name('user.update');
            Route::get('{id}/delete',[UserController::class,'delete'])->where('id','[0-9]+')->name('user.delete');
            Route::post('{id}/destroy',[UserController::class,'destroy'])->where('id','[0-9]+')->name('user.destroy');
            Route::post('change/role',[UserController::class,'changeRole'])->name('user.changerole');
        });
        /* ROLE */
        Route::prefix('role')->group(function(){
            Route::get('/',[RoleController::class,'index'])->name('role.view');
            Route::get('create',[RoleController::class,'create'])->name('role.create');
            Route::post('store',[RoleController::class,'store'])->name('role.store');
            Route::get('{id}/edit',[RoleController::class,'edit'])->where('id','[0-9]+')->name('role.edit');
            Route::post('{id}/update',[RoleController::class,'update'])->where('id','[0-9]+')->name('role.update');
            Route::get('{id}/delete',[RoleController::class,'delete'])->where('id','[0-9]+')->name('role.delete');
            Route::post('{id}/destroy',[RoleController::class,'destroy'])->where('id','[0-9]+')->name('role.destroy');
        });
        /* PERMISSION */
        Route::prefix('permission')->group(function(){
            Route::get('/',[PermissionController::class,'index'])->name('permission.view');
            Route::get('create',[PermissionController::class,'create'])->name('permission.create');
            Route::post('store',[PermissionController::class,'store'])->name('permission.store');
            Route::get('{id}/edit',[PermissionController::class,'edit'])->where('id','[0-9]+')->name('permission.edit');
            Route::post('{id}/update',[PermissionController::class,'update'])->where('id','[0-9]+')->name('permission.update');
            Route::get('{id}/delete',[PermissionController::class,'delete'])->where('id','[0-9]+')->name('permission.delete');
            Route::post('{id}/destroy',[PermissionController::class,'destroy'])->where('id','[0-9]+')->name('permission.destroy');
            Route::post('role',[PermissionController::class,'rolePermission'])->name('permission.role');
        });
        /* MENU */
        Route::prefix('menu')->group(function(){
            Route::get('create', [MenuController::class, 'create'])->name('menu.create');
            Route::post('store', [MenuController::class, 'store'])->name('menu.store');
        });
        /* MODULE */
        Route::prefix('module')->group(function(){
            Route::get('/',[ModuleController::class,'index'])->name('module.view');
            Route::get('create',[ModuleController::class,'create'])->name('module.create');
            Route::post('store',[ModuleController::class,'store'])->name('module.store');
            Route::get('{id}/edit',[ModuleController::class,'edit'])->where('id','[0-9]+')->name('module.edit');
            Route::post('{id}/update',[ModuleController::class,'update'])->where('id','[0-9]+')->name('module.update');
            Route::get('{id}/delete',[ModuleController::class,'delete'])->where('id','[0-9]+')->name('module.delete');
            Route::post('{id}/destroy',[ModuleController::class,'destroy'])->where('id','[0-9]+')->name('module.destroy');
        });
        /* LANGUAGE */
        Route::prefix('language')->group(function(){
            Route::get('/',[LanguageController::class, 'index'])->name('admin.language');
            Route::get('create',[LanguageController::class, 'create'])->name('admin.language.create');
            Route::post('store',[LanguageController::class, 'store'])->name('admin.language.store');
            Route::get('{id}/edit',[LanguageController::class, 'edit'])->where('id','[0-9]+')->name('admin.language.edit');
            Route::post('{id}/update',[LanguageController::class, 'update'])->where('id','[0-9]+')->name('admin.language.update');
            Route::get('{id}/delete',[LanguageController::class, 'delete'])->where('id','[0-9]+')->name('admin.language.delete');
            Route::post('{id}/destroy',[LanguageController::class, 'destroy'])->where('id','[0-9]+')->name('admin.language.destroy');
            Route::get('{id}/switch',[LanguageController::class, 'switchLanguage'])->name('admin.language.switch');
        });
        Route::get('dashboard', [BackendController::class, 'dashboard'])->name('dashboard');
    });
});

Route::get('admin',[AuthController::class, 'index'])->name('auth.admin')->middleware('login');
Route::post('login',[AuthController::class, 'login'])->name('auth.login');
Route::get('logout',[AuthController::class, 'logout'])->name('auth.logout');
/* Forgot Password */
Route::get('forgot/password', function(){
    return view('auth.forgotpassword');
})->middleware('guest')->name('forgot.password');
Route::post('forgot-password',[AuthController::class, 'sendResetLink'])->middleware('guest')->name('password.email');
Route::get('reset-password/{token}', function (string $token){
    return view('auth.resetpassword', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('reset-password',[AuthController::class, 'resetPassword'])->middleware('guest')->name('password.update');

/* AJAX */
Route::post('/ajax/menu/createPosition',[AjaxMenuController::class, 'menuPositionCreate']);
Route::get('/ajax/menu/getChilds',[AjaxMenuController::class, 'getChilds']);
Route::post('/ajax/switchStatus',[AjaxController::class, 'switchStatus']);
Route::post('/ajax/changeStatusAll',[AjaxController::class, 'changeStatusAll']);
Route::post('/ajax/getLocation',[AjaxController::class, 'getLocation']);