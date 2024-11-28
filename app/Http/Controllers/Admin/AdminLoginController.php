<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;



class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {                                //追記
        logout as performLogout;                            //追記
    }                               

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        // $this->middleware('auth:admin')->only('logout');

    }

    public function showloginForm()
    {
        return view('admin.auth.login');
    }
    
    protected function guard() // guardは「ログイン機構の種類」ログイン画面の数だけguardがある。
    {
        return Auth::guard('admin');
    }

    public function login(LoginRequest $request){

        $login_info = $request->only(['email','password']);

        // ユーザー情報が見つかったらログイン
        if(Auth::guard('admin')->attempt($login_info)){
            // ログイン後に表示するページにリダイレクト
            return redirect()->route('admin.top')->with([
                'message'=>'ログインしました',
            ]);
        } else {
        // ログインできなかったら元のページに戻る
        return back()->withErrors([
            'message' => ['ログインに失敗しました'],
        ]);
    }
    }

    // ログアウト処理
    public function logout(Request $request){
        $this->performLogout($request);
        return redirect('admin/auth/login');
    }

}
