<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\AdminRegisterController;
use App\Http\Controllers\Admin\AdminLoginController;
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

// 管理者認証機能
Route::prefix('admin')->group(function () {
    Route::get('/auth/login', [AdminLoginController::class, 'showLoginForm'])->name('show.admin.login');
    Route::post('/auth/login', [AdminLoginController::class,'login'])->name('admin.login');
    Route::view('/top','admin.top')->middleware(['auth:admin'])->name('show.admin.top');
    Route::view('/auth/register', 'admin.auth.register');
    Route::post('/auth/register', [AdminRegisterController::class, 'register'])->name('admin.register');
    });
    
// ユーザー認証
    Route::get('user/auth/login', [LoginController::class, 'showloginForm'])->name('show.user.login');
    Route::post('user/auth/login', [LoginController::class, 'login'])->name('user.login');
    Route::get('user/auth/logout', [LoginController::class, 'logout'])->name('user.logout');
    Route::get('user/auth/register', [RegisterController::class, 'showRegisterForm'])->name('show.user.register');
    Route::post('user/auth/register',[RegisterController::class, 'register'])->name('user.register');

// マルチログイン - ユーザーと管理者ログアウト
    Route::middleware('auth:web')->post('user/auth/logout', [LoginController::class, 'logout'])->name('user.logout');
    Route::middleware('auth:admin')->post('admin/auth/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');


// ユーザーカリキュラム画面
Route::controller(CurriculumController::class)
    ->prefix('/user/curriculum_list')
    ->group(function(){
        Route::get('/','showCurriculumLists')->middleware(['auth:web'])->name('show.curriculum');
        Route::get('/{grade_id}/{currentDate}','moveGradeCurriculumLists'); //学年移動
        Route::get('/month/{grade_id}/{currentDate}','moveMonthCurriculumLists'); //月移動
        Route::get('/delivery/{id}','showCurriculumDetail')->middleware(['auth:web'])->name('show.curriculum.detail'); //カリキュラム詳細
    });

// 管理者バナー編集画面
Route::controller(BannerController::class)
    ->prefix('/admin/banner_edit')
    ->group(function(){
        Route::get('/','showBannerEdit')->middleware(['auth:admin'])->name('show.banner_edit');
        Route::post('/','saveBanners')->name('save.banners'); //バナー画像保存
        Route::delete('destroy/{id}','deleteBanner')->name('delete.banner'); //バナー画像削除
    });

?>


