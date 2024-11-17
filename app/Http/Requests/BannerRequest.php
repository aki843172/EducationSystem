<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'image' => 'max:1000'
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
            'image' => 'バナー画像'
        ];
    }

     /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages() {
        return [
            'image.max' => ':attributeは:max字以内で入力してください。'
        ];
    }
}
