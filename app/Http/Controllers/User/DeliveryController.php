<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\CurriculumProgress;
use App\Models\DeliveryTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    public function showDelivery($id)
    {
        // 指定されたIDのカリキュラムを取得
        $curriculum = Curriculum::findOrFail($id);
        $userId = Auth::id();

        // 配信動画の条件を確認
        $isAvailable = $this->isVideoAvailable($curriculum);

        // ユーザーの進捗を取得
        $progress = CurriculumProgress::where('user_id', $userId)
            ->where('curriculum_id', $id)
            ->first();

        return view('user.delivery', compact('curriculum', 'isAvailable', 'progress'));
    }

    private function isVideoAvailable($curriculum)
    {
        // 常時公開フラグがONの場合
        if ($curriculum->alway_delivery_flg) {
            return true;
        }

        // 配信期間のチェック
        $now = now();
        $deliveryTimes = DeliveryTime::where('curriculums_id', $curriculum->id)
            ->where('delivery_from', '<=', $now)
            ->where('delivery_to', '>=', $now)
            ->first();

        // 配信期間内であれば動画は表示可能
        return !is_null($deliveryTimes);
    }
}
