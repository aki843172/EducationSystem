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



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // ログアウト後にリダイレクトする先を指定
})->name('logout');


Route::prefix('user')->namespace('User')->name('user.')->group(function () {

    Route::get('/login', [App\Http\Controllers\User\Auth\LoginController::class, 'showLoginForm'])->name('show.login');
    Route::post('/login', [App\Http\Controllers\User\Auth\LoginController::class, 'login']);

    Route::get('/register', [App\Http\Controllers\User\Auth\RegisterController::class, 'showRegisterForm'])->name('show.register');
    Route::post('/register', [App\Http\Controllers\User\Auth\RegisterController::class, 'register']);
    
    Route::get('/delivery/{id}', [App\Http\Controllers\User\DeliveryController::class, 'showDelivery'])->name('show.delivery');

    Route::get('/top', [App\Http\Controllers\User\TopController::class, 'showtop'])->name('show.top');

    Route::get('/curriculum_list',[App\Http\Controllers\User\CurriculumController::class,'showCurriculumList'])->name('show.curriculum');
    Route::post('/curriculum_list', [App\Http\Controllers\User\CurriculumController::class, 'curriculum']);
    
    Route::get('/progress', [App\Http\Controllers\User\ProgressController::class, 'showProgress'])->name('show.progress');
    Route::post('/progress', [App\Http\Controllers\User\ProgressController::class, 'progress']);

    Route::get('/profile', [App\Http\Controllers\User\ProfileController::class, 'showProfileForm'])->name('show.profile');
    Route::post('/profile', [App\Http\Controllers\User\ProfileController::class, 'profile']);

});

