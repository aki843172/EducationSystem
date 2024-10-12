<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Curriculum; // ここではカリキュラムモデルを使用
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

        // 配信ページのビューを返す
        return view('user.delivery', compact('curriculum'));
    }
}
