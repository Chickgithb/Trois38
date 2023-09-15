<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\BranchesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Finance_calendersController;
use App\Http\Controllers\Admin\Admin_panel_settingController;

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

define('PC',32);
Route::group(['prefix'=>'admin', 'middleware'=>'auth:admin'], function(){
    Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('/logout',[LoginController::class,'logout'])->name('admin.logout');

                        //الضبط العام

    Route::get('/generalSettings',[Admin_panel_settingController::class,'index'])->name('admin_panel_settings');
    Route::get('/generalSettingsEdit',[Admin_panel_settingController::class,'edit'])->name('admin_panel_settings_edit');
    Route::get('/generalSettingsUpdate',[Admin_panel_settingController::class,'update'])->name('admin_panel_settings_update');


                        //السنوات المالية
    Route::resource('finance_calenders',Finance_calendersController::class);
    Route::get('/finance_calenders/delete/{id}',[Finance_calendersController::class, 'destroy'])->name('finance_calenders.delete');
    Route::post('/finance_calenders/show_year_monthes',[Finance_calendersController::class,'show_year_monthes'])->name('finance_calenders.show_year_monthes');
    Route::get('/finance_calenders/do_open/{id}', [Finance_calendersController::class,'do_open'])->name('finance_calenders.do_open');


                        //بداية الفروع
    Route::get('/branches',[BranchesController::class,'index'])->name('branches.index');
    Route::get('/branchesCreate',[BranchesController::class,'create'])->name('branches.create');
    Route::post('/branchesStore',[BranchesController::class,'store'])->name('branches.store');
    Route::get('/branchesEdit{id}',[BranchesController::class,'edit'])->name('branches.edit');
    Route::post('/branchesUpdate/{id}',[BranchesController::class,'update'])->name('branches.update');
    Route::get('/branchesDelete/{id}',[BranchesController::class,'destroy'])->name('branches.delete');

});


Route::group(['namespace'=>'Admin', 'prefix'=>'admin','middleware'=>'guest:admin'], function(){
    Route::get('login',[LoginController::class,'get_login_view'])->name('admin.getlogin');
    Route::post('login',[LoginController::class,'login'])->name('admin.login');

});


