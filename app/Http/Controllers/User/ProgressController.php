<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CurriculumProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Grade;


class ProgressController extends Controller
{
    public function markAsCleared(Request $request)
    {
        $request->validate([
            'curriculum_id' => 'required|exists:curriculums,id',
        ]);

        CurriculumProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'curriculum_id' => $request->curriculum_id,
            ],
            ['clear_flg' => 1]
        );

        return redirect()->route('user.show.delivery', $request->curriculum_id)->with('success', '受講しました！');
    }

    public function index()
    {
        // 現在のユーザー情報を取得
        $user = Auth::user();

            if ($user) {
                echo $user->name;
            } else {
                echo "ユーザーが見つかりません";
            }

        // 仮の学年情報（実際はデータベースから取得）
        $currentGrade = Grade::findOrFail($user->grade_id);

        $curriculums = [];
        // 学年ごとにカリキュラムと進捗情報を取得
        $grades = Grade::with(['curriculums.progress'])->get();
            foreach ($grades as $grade) {
                $gradeName = $grade->name;
                foreach ($grade->curriculums as $curriculum) {
                    // 進捗データがあればクリアフラグを取得
                    $progress = $curriculum->progress->first();
                    $isCompleted = $progress ? ($progress->clear_flg == 1) : false;
                    $curriculums[$gradeName][] = (object)[
                        'title' => $curriculum->title,
                        'id' => $curriculum->id,
                        'is_completed' => $isCompleted
                    ];
                }
            }

        // 授業進捗画面を表示
        return view('progress.index', compact('user', 'currentGrade', 'curriculums'));
    }
}
