<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SiteConfigurationController;
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


Route::get('login',[LoginController::class,'index'])->name('login');
Route::post('login',[LoginController::class,'login'])->name('auth.login');

Route::get('logout',[LoginController::class,'logout'])->name('auth.logout');

Route::group(['middleware'=>'auth','prefix'=>'management'],function(){
    Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('site-configuration',[SiteConfigurationController::class,'index'])->name('site configuration');
    Route::get('/admins',[AdminController::class,'index'])->name('admins.index');
    Route::get('permissions',[PermissionController::class,'index'])->name('permissions.index');
    Route::get('permissions/{id}/update',[PermissionController::class,'update'])->name('permissions.update');
    Route::post('permissions/store',[PermissionController::class,'store'])->name('permissions.store');
    Route::delete('permissions/{id}/destroy',[PermissionController::class,'destroy'])->name('permissions.destroy');
    Route::get('roles',[RoleController::class,'index'])->name('roles.index');
    Route::put('roles/{id}/update',[RoleController::class,'update'])->name('roles.update');
    Route::post('roles/store',[RoleController::class,'store'])->name('roles.store');
    Route::delete('roles/{id}/destroy',[RoleController::class,'destroy'])->name('roles.destroy');
});

