<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminTopController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\AdminRegisterController;
use App\Http\Controllers\Admin\AdminLoginController;
use app\Http\Controllers\Auth\RegisterController;
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
// Route::get('/', function () {
//     return redirect()->route('login')->middleware('auth');
// });


// 管理者認証機能
Route::prefix('admin')->group(function () {
    // ログイン画面
    Route::get('auth/login', [AdminLoginController::class, 'showloginForm'])->name('show.admin.login');
    // Route::view('auth/login', 'admin.auth.login')->name('show.admin.login');
    // ログイン送信
    Route::post('auth/login', [AdminLoginController::class,'login'])->name('admin.login');
    
    Route::view('/top','admin.top')->middleware(['auth:admin'])->name('show.admin.top');
    // 管理者 新規登録画面
    Route::view('auth/register', 'admin.auth.register');
    // 管理者 新規登録機能
    Route::post('auth/register', [AdminRegisterController::class, 'create'])->name('admin.register');
    });

    Route::group(['middleware' => 'auth'], function(){
        // 管理者ログアウト機能
        Route::get('admin/auth/logout', [AdminLoginController::class,'logout'])->name('admin.logout');

   });
    
// ユーザー認証
    Route::get('user/auth/login', [LoginController::class, 'showloginForm'])->name('show.user.login');
    Route::post('user/auth/login', [LoginController::class, 'login'])->name('user.login');
    Route::get('user/auth/logout', [LoginController::class, 'logout'])->name('user.logout');
    Route::view('user/auth/register','user.auth.register');


// ユーザーカリキュラム画面
Route::controller(CurriculumController::class)
    ->prefix('user/curriculum_list')
    ->group(function(){
        Route::get('/','showCurriculumLists')->middleware(['auth:web'])->name('show.curriculum');
        Route::get('{id}','moveGradeCurriculumLists')->name('move.grade.curriculum');
        Route::get('month/{currentMonth}','moveMonthCurriculumLists')->name('move.month.curriculum');
        Route::get('delivery/{id}','showCurriculumDetail')->middleware(['auth:web'])->name('show.curriculum.detail');
    });

// 管理者バナー編集画面
Route::controller(BannerController::class)
    ->prefix('/admin/banner_edit')
    ->group(function(){
        Route::get('/','showBannerEdit')->name('show.banner_edit');
        Route::post('/','saveBanners')->name('save.banners');
        Route::delete('destroy/{id}','deleteBanner')->name('delete.banner');
    });

?>


