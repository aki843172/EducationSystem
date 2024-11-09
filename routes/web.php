<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\TopController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\User\CurriculumController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

// 未ログイン時、ログイン画面へリダイレクト
Route::get('/', function () {
    return redirect()->route('login')->middleware('auth');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// 管理者トップ画面
Route::view('/admin/top','admin.top')->name('show.top');

// ユーザーカリキュラム画面
Route::controller(CurriculumController::class)
    ->prefix('/user/curriculum_list')
    ->group(function(){
        Route::get('/','showCurriculumLists')->name('show.curriculum');
        Route::get('/delivery/{id}','showCurriculumDetail')->name('show.detail');
    });

// 管理者バナー編集画面
Route::controller(BannerController::class)
    ->prefix('/admin/banner_edit')
    ->group(function(){
        Route::get('/','showBannerEdit');
    });

?>


