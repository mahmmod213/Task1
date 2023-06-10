<?php

use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Admin" middleware group. Now create something great!
|
*/


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    Route::group(["prefix" => "admin",'middleware' => 'guest:admin'],function (){
        // You Are Not Required Login
        Route::get('login',[AuthController::class,'showForm'])->name('admin.show.form');
        Route::post('login',[AuthController::class,'login'])->name('admin.login');
        Route::get('/get-QRCode/{id}',[UserController::class,'get_QRCode'])->name('admin.users.getQRCode');
    });

    Route::group(["prefix" => "admin",'middleware' => 'auth:admin'],function (){
        // You Are Required Login
        Route::get('dashboard',[AuthController::class,'showDashboard'])->name('admin.dashboard');
        Route::post('logout',[AuthController::class,'logout'])->name('admin.logout');

        Route::group(['prefix' => 'users'],function (){
           Route::get('/',[UserController::class,'index'])->name('admin.users');
           Route::get('/create',[UserController::class,'create'])->name('admin.users.create');
           Route::post('/store',[UserController::class,'store'])->name('admin.users.store');
           Route::get('/edit/{id}',[UserController::class,'edit'])->name('admin.users.edit');
           Route::post('/update/{id}',[UserController::class,'update'])->name('admin.users.update');
           Route::post('/destroy',[UserController::class,'destroy'])->name('admin.users.destroy');
           Route::get('/change-status/{id}',[UserController::class,'changeStatus'])->name('admin.users.changeStatus');
           Route::get('/generate-QR/{id}',[UserController::class,'generateQR'])->name('admin.users.generateQR');
        });
    });

});




