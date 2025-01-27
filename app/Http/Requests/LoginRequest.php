<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'max:1000',
            'kana' => 'max:1000',
            'email' => 'max:1000',
            'password' => 'max:1000',
        ];
    }
         /**
     * 項目名
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => '名前',
            'kana' => 'カナ',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }
    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages() {
        return [
            'name.required' => ':attributeは必須項目です。',
            'name.max' => ':attributeは:max字以内で入力してください。',
            'email.required' => ':attributeは必須項目です。',
            'email.max' => ':attributeは:max字以内で入力してください。'
        ];
    }
}
