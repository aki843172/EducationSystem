<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function  showRegisterForm()
    {
        return view('user.auth.register');
    }

    public function register(Request $request)
    {
          // バリデーションを実行
        $this->validateRegistration($request);

        // ユーザーを作成
        $user = $this->create($request->all());

        return redirect()->route('user.show.login');
    }


    protected function validateRegistration(Request $request)
    {
        // バリデーションルールの定義
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'name_kana' => 'required|string|min:1|max:255|regex:/^[ァ-ヶー]+$/u', // カタカナのみ
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|max:255|alpha_num', // 半角英数字
            'password_confirmation' => 'required|string|same:password', // 確認用パスワード
        ], [
            'name.required' => '*ユーザーネームを入力してください。',
            'name_kana.required' => '*カナを入力してください。',
            'name_kana.regex' => '*カナはカタカナで入力してください。',
            'email.required' => '*メールアドレスを入力してください。',
            'password.required' => '*パスワードを入力してください。',
            'password.min' => '*パスワードは8文字以上で指定してください。',
            'password.alpha_num' => '*パスワードは半角で入力してください。',
            'password_confirmation.required' => '*パスワード確認を入力してください。',
            'password_confirmation.same' => '*パスワードが一致しません。',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'name_kana' => $data['name_kana'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'grade_id' => 1, // デフォルトの学年IDを設定
        ]);
    }
}
