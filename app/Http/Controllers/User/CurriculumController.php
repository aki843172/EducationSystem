<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\User;

class CurriculumController extends Controller
{
    function showCurriculumLists(){

        $datetime = date('Y-m-d H:i');
        $curriculums = Curriculum::all();
        // grade_id の取得
        // always_delivery_flg の取得

        // 【作成期日:11/17】
        // table:delivery_times の「always_delivery_flag」がオンになっている
        // 上記「always_delivery_flag」がオフの場合は、table:delivery_times の「delivery_from」「delivery_to」に当てはまる
        // かつ、table:curriculums の「grade_id」とログインユーザーの「grade_id」が合致する

        // 該当するものをcurriculumsテーブルから取得

        return view ('user.curriculum_list', compact('curriculums'));
    }

    function showCurriculumDetail(){
        
        // $curriculumId = 押下したカリキュラムのidを取得
        return to_route('show.detail', 'idを渡す');
        
    }

}