<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CurriculumRequest;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use App\Models\User;

class CurriculumController extends Controller
{

    function showCurriculumLists(CurriculumRequest $request){

        // ログインユーザーの学年
        $user = Auth::user();
        $grade_id = $user->id; 

        // 今の年月日を取得
        $currentDateTime = date('Y-m-d H:i:s');
        $currentYear = date('Y');
        $currentMonth = date('m');

        // deliverytimesテーブルの情報を取得
        $delivery_times = DeliveryTime::query();

        // curriculumsテーブルにdelivery_timesテーブルを合体する
        $curriculums = Curriculum::query();
        $curriculums->select('curriculums.*', 'delivery_from','delivery_to')->join('delivery_times', 'curriculums.id', '=', 'delivery_times.curriculums_id');

        // 学年が一致するデータを取得
        $curriculums->where('grade_id','=', $grade_id);


        foreach($curriculums as $curriculum){
                // 常時配信フラグがオフの時
                if($curriculum->always_delivery_flg === 0){
                    // 配信期間に一致するデータを取得
                    $curriculum->where('delivery_from','<=', $currentDateTime);
                    $curriculum->where('delivery_to','>=',$currentDateTime);

                    $curriculums = $curriculum;
                    }
                // オンの時は特になにもしない
                if($curriculum->always_delivery_flg === 1){
                    $curriculums = $curriculum;
                }
            }
        
        // 絞り込んだデータをresultへ入れる
        $result = $curriculums->get();

        return view ('user.curriculum_list', compact('result','currentYear','currentMonth'));
    }


    // 学年ボタンを押下　学年移動機能
    function moveGradeCurriculumLists($id){

        $curriculums = Curriculum::query();
        $delivery_times = DeliveryTime::query();

        // 今の年月日を取得
        $currentDate = date('Y-m-d H:i:s');

        // curriculumsテーブルにdelivery_timesテーブルを合体する
        $curriculums->join('delivery_times', 'curriculums.id', '=', 'delivery_times.curriculums_id')->get();

        
        // grade_idが指定されている場合、その学年のカリキュラムを取得
        $curriculums->where('grade_id', '=', $id->id);
        

        // もし上記カリキュラムの常時配信がOFFであれば、配信期間に合うものを取得
        if($curriculums->always_delivery_flg == 0){
            $curriculums->where('delivery_from','<=', $currentDate);
            $curriculums->where('delivery_to','>=',$currentDate);
        };
        

        // 絞り込んだデータをshow_curriculumsへ入れる
        $show_curriculums = $curriculums->get();
        var_dump($show_curriculums);

        // データをjsonで返す
        return response()->json($show_curriculums);
    }


    // 矢印ボタンを押した　月移動機能
    function moveMonthCurriculumLists($data){

        $curriculums = Curriculum::query();

        // curriculumsテーブルにdelivery_timesテーブルを合体する
        $curriculums->join('delivery_times', 'curriculums.id', '=', 'delivery_times.curriculums_id');
        echo $curriculums;
        
        // grade_idが指定されている場合、その学年のカリキュラムを取得
        if($data){
            $curriculums->where('grade_id', '=', $data->grade_id);
        }

        // もし上記カリキュラムの常時配信がOFFであれば、配信期間に合うものを取得
        if($curriculums->always_delivery_flg == 0){
            $curriculums->where('delivery_from','<=', $data->date)->where('delivery_to','>=',$data->date);
        };

        // 絞り込んだデータをshow_curriculumsへ入れる
        $show_curriculums = $curriculums->get();

        // データをjsonで返す
        return response()->json($show_curriculums);
    }

    function showCurriculumDetail($id){
        
        // $curriculumId = 押下したカリキュラムのidを取得
        return to_route('show.detail', $id);
        
    }

}