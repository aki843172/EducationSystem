<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CurriculumProgress;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    
    public function markAsComplete($id)
    {
        

        \Log::info('markAsComplete called with ID:', ['id' => $id]);
        try {
            DB::beginTransaction();

            $usersId = auth()->id();
            
            // 進捗データの取得または新規作成
            $progress = CurriculumProgress::firstOrNew([
                'curriculums_id' => $id,
                'users_id' => $usersId
            ]);

            // 完了フラグを設定
            $progress->clear_flg = 1;
            $progress->save();

            DB::commit();

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Complete Error:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false], 500);
        }
        

    }
    

}
