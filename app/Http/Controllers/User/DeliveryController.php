<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\CurriculumProgress;
use App\Models\DeliveryTime;
use App\Models\CurriculumClearCheck;
use App\Models\Banner;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{
    public function showDelivery($id)  
    {

        // トランザクション開始
        DB::beginTransaction();

        try {
            \Log::info('showDelivery method started');
        
            $curriculum = Curriculum::findOrFail($id);
            \Log::info('Curriculum found', ['id' => $curriculum->id]);
    
            $usersId = auth()->id();
            \Log::info('User ID', ['id' => $usersId]);

            // 進捗の取得
            $progress = CurriculumProgress::where('curriculums_id', $id)
                ->where('users_id', $usersId)
                ->first();

            // 配信期間の確認
            $deliveryTimes = DeliveryTime::where('curriculums_id', $id)->get();

            // 動画表示の条件をチェック
            $canShowVideo = $this->canShowVideo($curriculum, $progress, $deliveryTimes);

            // 受講ボタン表示の条件をチェック
            $canShowCompleteButton = $this->canShowCompleteButton($curriculum, $progress, $deliveryTimes);

            $banner = Banner::first(); 
           

            // トランザクションのコミット
            DB::commit();

            // ビューにデータを渡す
            return view('user.delivery', compact(
                'curriculum',
                'progress',
                'canShowVideo',
                'canShowCompleteButton',
                'banner'
                ));

        } catch (\Exception $e) {
            // エラーが発生した場合はロールバック
            DB::rollBack();
            // エラーメッセージを表示
            return redirect()->back()->withErrors(['error' => 'データの取得に失敗しました。']);
        }
    }


        // 受講ボタン表示の判定メソッドを追加
    private function canShowCompleteButton($curriculum, $progress, $deliveryTimes)
    {
        \Log::info('Complete Button Check:', [
            'curriculums_id' => $curriculum->id,
            'progress' => $progress,
            'always_delivery_flg' => $curriculum->always_delivery_flg,
            'delivery_times' => $deliveryTimes->toArray()
        ]);

        // 未受講チェック（progressがnullか、clear_flagが0）
        if ($progress === null || $progress->clear_flg == 0) {
            // 常時公開チェック
            if ((int)$curriculum->always_delivery_flg === 1) {
                return true;
            }

            // 配信期間チェック
            $now = now();
            foreach ($deliveryTimes as $time) {
                if ($now->between($time->delivery_from, $time->delivery_to)) {
                    return true;
                }
            }
        }

    return false;
}
    // 動画表示の条件を確認するメソッド
    private function canShowVideo($curriculum, $progress, $deliveryTimes)
    {

        // デバッグ用にログを出力
        \Log::info('Flag Value:', ['always_delivery_flg' => $curriculum->always_delivery_flg]);
        
        // 常時公開フラグのチェック（整数として明示的に比較）
        if ((int)$curriculum->always_delivery_flg === 1) {
            return true;
        }

        // 現在の日時を取得
        $now = now();

        // 配信期間内のチェック
        foreach ($deliveryTimes as $time) {
            if ($now->between($time->delivery_from, $time->delivery_to)) {
                return true;
            }
        }

        // 受講済みかどうかのチェック
        if ($progress && $progress->clear_flg == 0) {
            return true;
        }

        return false;
       

    }
    
    
}