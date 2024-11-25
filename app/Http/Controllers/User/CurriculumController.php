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
        $currentDate = date('Y-m-d');

        // curriculumsテーブルからユーザーの学年に合うものを取得
        $curriculums = Curriculum::where('grade_id',$grade_id)->get();

        // deliverytimesテーブルの情報を取得
        $delivery_times = DeliveryTime::query();

        // curriculumsテーブルにdelivery_timesテーブルを合体する
        $curriculums = Curriculum::join('delivery_times', 'curriculums.id', '=', 'delivery_times.curriculums_id')->get();

        // 学年とflagがOFFの場合に配信期間内に入っているカリキュラムを取得
        foreach($curriculums as $curriculum){
            foreach($curriculum as $item){
            if($item->always_delivery_flg == '0'){

                $item->whereDate('delivery_from','<=', $currentDate)->get(); //whereDate()なら時間まで指定しなくても比較演算子で判定できるらしい？
                $item->whereDate('delivery_to','>=',$currentDate)->get();
                $curriculums = $item;
                
            } elseif ($item->always_delivery_flg == 1){
                $curriculum->get();
            }
        }
    }
    
        // 絞り込んだデータをshow_curriculumsへ入れる
        $show_curriculums = $curriculums->get();

        return view ('user.curriculum_list', compact('show_curriculums'));
    }

    // 矢印ボタンまたは学年ボタンを押した際の検索機能
    function searchCurriculumLists(CurriculumRequest $request){

        $curriculums = Curriculum::query();
        $delivery_times = DeliveryTime::query();
        $date = $request->date;

        // curriculumsテーブルにdelivery_timesテーブルを合体する
        $curriculums->join('delivery_times', 'curriculums.id', '=', 'delivery_times.curriculums_id');

        
        // grade_idが指定されている場合、その学年のカリキュラムを取得
        if($request->grade_id){
            $curriculums->where('grade_id', '=', $request->grade_id);
        }

        // もし上記カリキュラムの常時配信がOFFであれば、配信期間に合うものを取得
        if($curriculums->always_delivery_flg == 0){
            $curriculums->where('delivery_from','<=', $date)->where('delivery_to','>=',$date)->get();;
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