<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Curriculum;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;


class CurriculumController extends Controller
{

    function showCurriculumLists(){

        // ログインユーザーの学年
        $user = Auth::user();
        $grade_id = $user->id;


        // 現在の年月日をcarbonで取得
        $datetime = new Carbon();

        $curriculums = Curriculum::select('curriculums.*', 'delivery_from', 'delivery_to')
            ->join('delivery_times', 'curriculums.id', '=', 'delivery_times.curriculums_id')
            ->where('grade_id',$grade_id)
            ->get();


        $filteredCurriculums = $curriculums->filter(function ($curriculum) use($datetime){ // 引数の$curriculumには、$curriculumsの各データが入っている
            if ($curriculum->always_delivery_flg == 1) {
                return true;
            }
            if ($curriculum->always_delivery_flg == 0) {
                // 'delivery_from' と 'delivery_to' の間に含まれる場合
                return $datetime->between($curriculum->delivery_from, $curriculum->delivery_to); // Carbonのbetweenメソッド（指定範囲内のデータを取得）
            }
            return false; // それ以外の場合はスルー
        });

        // 取得したデータをビューに渡す
        return view('user.curriculum_list', compact('filteredCurriculums','datetime'));
    }



    // 学年ボタンを押下　学年移動機能
    function moveGradeCurriculumLists($grade_id, $currentDate){

        $datetime = new Carbon();
        // currentDate を Carbon インスタンスに変換
        $datetime = Carbon::createFromFormat('Y-m', $currentDate);  // '2024-12'形式


        $curriculums = Curriculum::select('curriculums.*', 'delivery_from', 'delivery_to')
            ->join('delivery_times', 'curriculums.id', '=', 'delivery_times.curriculums_id')
            ->where('grade_id', $grade_id)
            ->get();


                // 常時配信フラグの条件分岐
                $filteredCurriculums = $curriculums->filter(function ($curriculum) use ($datetime) {
                    if ($curriculum->always_delivery_flg == 1) {
                        // 常時配信のデータはそのまま取得
                        return true;
                    }
                    if ($curriculum->always_delivery_flg == 0) {
                        // 'delivery_from' と 'delivery_to' の間に含まれる場合のみ取得
                        return $datetime->between($curriculum->delivery_from, $curriculum->delivery_to);
                    }
                    return false; // 他のケースは除外
                });
    

        // データが正常か確認するためログを出力
        Log::info('Curriculums:', $filteredCurriculums->toArray());
        Log::info('Datetime:', [$datetime->toDateTimeString()]);

        // JSONレスポンスとして返す
        return response()->json([
            'curriculums' => $filteredCurriculums->toArray(),
            'datetime' => $datetime->toDateTimeString(),
            'grade_id' => $grade_id,
        ]);
    }

    // 矢印ボタンを押した　月移動機能
    function moveMonthCurriculumLists($grade, $currentDate, Request $request){ //受け取るURLのIDは同じ順番通りに記載すべし

        $datetime = new Carbon();
        // currentDate を Carbon インスタンスに変換
        $datetimeOriginal = Carbon::createFromFormat('Y-m', $currentDate);  // '2024-12'形式

        // clickIdをリクエストから取得
        $clickId = $request->input('clickId');

        // curriculumsテーブルとdelivery_timesテーブルを結合し取得
        $curriculums = Curriculum::select('curriculums.*', 'delivery_from', 'delivery_to')
            ->join('delivery_times', 'curriculums.id', '=', 'delivery_times.curriculums_id')
            ->where('grade_id', $grade)
            ->get();

        // 月を進めたり戻したりする条件分岐
        if ($clickId === '#goNext') {
            $datetimeOriginal->addMonth();  // 次の月に進める
        } elseif ($clickId === '#goBack') {
            $datetimeOriginal->subMonth();  // 前の月に戻す
        }

        // 常時配信フラグの条件分岐
            $filteredCurriculums = $curriculums->filter(function ($curriculum) use ($datetimeOriginal) {
                if ($curriculum->always_delivery_flg == 1) {
                    // 常時配信のデータはそのまま取得
                    return true;
                }
                if ($curriculum->always_delivery_flg == 0) {
                    // 'delivery_from' と 'delivery_to' の間に含まれる場合のみ取得
                    return $datetimeOriginal->between($curriculum->delivery_from, $curriculum->delivery_to);
                }
                return false; // 他のケースは除外
            });

        // Y-m 形式で日付を取得
        $datetime = $datetimeOriginal->format('Y-m');  // 例: '2025-01'

        // データが正常か確認するためログを出力
        Log::info('Curriculums:', $filteredCurriculums->toArray());
        Log::info('Datetime:', [$datetime]);
        
        // JSONレスポンスとして返す
        return response()->json([
            'curriculums' => $filteredCurriculums->toArray(),
            'datetime' => $datetime,
            'gradeNum' => $grade
        ]);

    }

    function showCurriculumDetail($id){
        
        // $curriculumId = 押下したカリキュラムのidを取得
        return to_route('show.detail', ['id' => $id]);
        
    }

}