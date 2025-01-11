<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\TopController;
use App\Http\Controllers\User\DeliveryController;
use Illuminate\Support\Facades\Auth;

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




// 修正後のコード
Route::post('/logout', function () {
    Auth::logout();
    Session::flush();  // セッションをクリア
    Session::regenerate(true);  // セッションIDを再生成
    
    return redirect()->route('user.show.login')  // 名前付きルートを使用
        ->with('message', 'ログアウトしました');  // フラッシュメッセージを追加
})->name('logout')->middleware('auth');  // 認証ミドルウェアを追加




Route::prefix('user')->namespace('user')->name('user.')->group(function () {
    //認証関連
    Route::get('/login', [App\Http\Controllers\User\Auth\LoginController::class, 'showLoginForm'])->name('show.login');
    Route::post('/login', [App\Http\Controllers\User\Auth\LoginController::class, 'login']);
    Route::get('/register', [App\Http\Controllers\User\Auth\RegisterController::class, 'showRegisterForm'])->name('show.register');
    Route::post('/register', [App\Http\Controllers\User\Auth\RegisterController::class, 'register']);
    
    //配信関連
    Route::get('/delivery/{id}', [App\Http\Controllers\User\DeliveryController::class, 'showDelivery'])->name('show.delivery');
    // 受講完了用のルート 
    Route::post('/curriculum/{id}/complete', [App\Http\Controllers\User\CurriculumController::class, 'markAsComplete'])->name('curriculum.complete');

    //トップページ
    Route::get('/top', [App\Http\Controllers\User\TopController::class, 'showtop'])->name('show.top');

    // 共通ヘッダーのリンク先
    Route::get('/curriculum_list', [App\Http\Controllers\User\CurriculumController::class, 'showCurriculumList'])->name('show.curriculum');
    Route::get('/progress', [App\Http\Controllers\User\ProgressController::class, 'showProgress'])->name('show.progress');
    Route::get('/profile', [App\Http\Controllers\User\ProfileController::class, 'showProfileForm'])->name('show.profile');
    
});

