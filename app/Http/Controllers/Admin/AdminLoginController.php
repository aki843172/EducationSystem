<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



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
        $this->middleware('auth:admin')->only('logout');
    }

    protected function guard() // guardは「ログイン機構の種類」ログイン画面の数だけguardがある。
    {
        return Auth::guard('admin');
    }


    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ],
        [
            'email.required' => '*メールアドレスは必須項目です。',
            'email.email' => '*正しいメールアドレスを入力してください。',
            'password.required' => '*パスワードは必須項目です。',
            'password.min' => '*パスワードは最低6文字以上で入力してください。',
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => ['メールアドレスが一致しません。'],
            'password' => ['パスワードが一致しません。'],
        ]);
    }


    // ログアウト処理
    public function logout(Request $request){
        Auth::guard('admin')->logout(); // マルチログインの場合、guard指定が必要
        $request->session()->invalidate(); // セッションを無効化
        $request->session()->regenerateToken(); // CSRFトークンを再生成

        return redirect()->route('show.admin.login')->with('message', 'ログアウトしました');
}

}
