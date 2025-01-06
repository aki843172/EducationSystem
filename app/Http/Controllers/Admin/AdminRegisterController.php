<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest:admin');
    // }

    // protected function guard()
    // {
    //     return Auth::guard('admin');
    // }
    
    // 新規登録処理
    public function register(Request $request)
    {
        // バリデーション
        $this->validateRegistration($request);

        // 管理者の作成
        $admin = $this->createAdmin($request->all());

        auth('admin')->login($admin); // 管理者としてログイン

        return redirect()->route('show.admin.top')->with('message', '管理者が正常に作成されました'); //ログイン後のリダイレクト
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

     // バリデーションルール
    protected function validateRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'kana' => 'required|string|min:1|max:255|regex:/^[ァ-ヶー]+$/u',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|max:255|alpha_num',
            'password_confirmation' => 'required|string|same:password',
        ],
        [
            'name.required' => '*名前は必須項目です。',
            'name.max' => '*名前は255文字以下で入力してください。',
            'kana.required' => '*カナは必須項目です。',
            'kana.regex' => '*カタカナで入力してください。',
            'kana.max' => '*カナは255文字以下で入力してください。',
            'email.required' => '*メールアドレスは必須項目です。',
            'email.max' => '*メールアドレスは255文字以下で入力してください。',
            'password.required' => '*パスワードは必須項目です。',
            'password.min' => '*パスワードは8文字以上で入力してください。',
            'password.alpha_num' => '*パスワードは半角で入力してください。',
            'password_confirmation.required' => '*確認用パスワードは必須項目です。',
            'password_confirmation.same' => '*確認用パスワードが一致しません。',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Admin
     */

     // 管理者の作成
    protected function createAdmin(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'kana' => $data['kana'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
