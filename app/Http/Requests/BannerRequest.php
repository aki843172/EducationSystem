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
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:255',
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
            'image.*.image' => '画像ファイルをアップロードしてください。',
            'image.*.max' => '画像ファイルのサイズは255以下にしてください。',
            'image.mimes' => '画像形式は jpeg, png, jpg, gif, svg のみ許可されています。',

        ];
    }
}
