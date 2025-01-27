<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurriculumRequest extends FormRequest
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
            'title' => 'max:1000',
            'thumbnail' => 'max:1000',
            'description' => 'max:1000',
            'video_url' => 'max:1000',
            'always_delivery_flg' => 'max:1000',
            'grade_id' => 'max:1000'
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
            'title' => 'タイトル',
            'thumbnail' => '授業サムネイル画像',
            'description' => '授業詳細',
            'video_url' => 'ビデオURL',
            'always_delivery_flg' => '常時配信フラグ',
            'grade_id' => '学年ID'
        ];
    }

}
