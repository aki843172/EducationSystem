<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/curriculum_list';


    public function showloginForm()
    {
        return view('user.auth.login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|alpha_num',
        ],
        [
            'email.required' => '*メールアドレスは必須項目です。',
            'password.required' => '*パスワードは必須項目です。',
            'password.alpha_num' => '*パスワードは半角英数字で入力してください。',
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
        Auth::guard('web')->logout(); // マルチログインの場合、guard指定が必要
        $request->session()->invalidate(); // セッションを無効化
        $request->session()->regenerateToken(); // CSRFトークンを再生成
    
        return redirect()->route('show.user.login')->with('message', 'ログアウトしました');}

}
