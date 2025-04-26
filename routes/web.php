<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
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
});