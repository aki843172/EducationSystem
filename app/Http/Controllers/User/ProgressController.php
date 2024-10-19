<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CurriculumProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
