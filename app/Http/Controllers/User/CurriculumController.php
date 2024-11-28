<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\CurriculumRequest;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use App\Models\User;
use Illuminate\Support\Facades\Date;

class CurriculumController extends Controller
{

    function showCurriculumLists(CurriculumRequest $request){

        // ログインユーザーの学年
        // $user = Auth::user();
        $grade_id = 1; //仮で1年生とする

        // 今の年月日を取得
        $currentDate = date('Y-m-d H:i:s');

        // deliverytimesテーブルの情報を取得
        $delivery_times = DeliveryTime::query();

        // curriculumsテーブルにdelivery_timesテーブルを合体する
        $curriculums = Curriculum::join('delivery_times', 'curriculums.id', '=', 'delivery_times.curriculums_id')->get();

        // 配列内の数だけ処理をする
        foreach($curriculums as $curriculum){
            // ユーザーの学年に一致するものを取得
            $data = $curriculum->where('grade_id','=',$grade_id)->get();

            // 常時配信フラグがオフの時
            if($data['always_delivery_flg'] === 0){
                $data->where('delivery_from','<=', $currentDate)->get();
                $data->where('delivery_to','>=',$currentDate)->get();
                }
            // オンの時は特になにもしない
        }
    
        // 絞り込んだデータをshow_curriculumsへ入れる
        // $curriculums = $data->get();

        return view ('user.curriculum_list', compact('curriculums'));
    }


    // 学年ボタンを押下　学年移動機能
    function moveGradeCurriculumLists($id){

        $curriculums = Curriculum::query();
        $delivery_times = DeliveryTime::query();

        $grade_id = $id->grade_id;
        dd($grade_id);


        // 今の年月日を取得
        $currentDate = date('Y-m-d');

        // curriculumsテーブルにdelivery_timesテーブルを合体する
        $curriculums->join('delivery_times', 'curriculums.id', '=', 'delivery_times.curriculums_id');

        
        // grade_idが指定されている場合、その学年のカリキュラムを取得
        if($grade_id){
            $curriculums->where('grade_id', '=', $grade_id)->get();
        }

        // もし上記カリキュラムの常時配信がOFFであれば、配信期間に合うものを取得
        if($curriculums->always_delivery_flg == 0){
            $curriculums->whereDate('delivery_from','<=', $currentDate)->whereDate('delivery_to','>=',$currentDate)->get();
        };
        

        // 絞り込んだデータをshow_curriculumsへ入れる
        $show_curriculums = $curriculums->get();
        echo($show_curriculums);

        // データをjsonで返す
        return response()->json($show_curriculums);
    }


    // 矢印ボタンを押した　月移動機能
    function moveMonthCurriculumLists(CurriculumRequest $request){

        $curriculums = Curriculum::query();
        $delivery_times = DeliveryTime::query();
        $currentDate = $request->currentMonth;
        dd($currentDate);

        // curriculumsテーブルにdelivery_timesテーブルを合体する
        $curriculums->join('delivery_times', 'curriculums.id', '=', 'delivery_times.curriculums_id');

        
        // grade_idが指定されている場合、その学年のカリキュラムを取得
        if($request->grade_id){
            $curriculums->where('grade_id', '=', $request->grade_id);
        }

        // もし上記カリキュラムの常時配信がOFFであれば、配信期間に合うものを取得
        if($curriculums->always_delivery_flg == 0){
            $curriculums->where('delivery_from','<=', $currentDate)->where('delivery_to','>=',$currentDate)->get();;
        };
        

        // 絞り込んだデータをshow_curriculumsへ入れる
        $show_curriculums = $curriculums->get();
        echo($show_curriculums);

        // データをjsonで返す
        return response()->json($show_curriculums);
    }

    function showCurriculumDetail($id){
        
        // $curriculumId = 押下したカリキュラムのidを取得
        return to_route('show.detail', $id);
        
    }

}