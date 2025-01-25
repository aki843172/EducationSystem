<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\BannerRequest;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    function showBannerEdit(){

        $banners = Banner::all();
        return view('admin.banner_edit', compact('banners'));
    }

    function saveBanners(BannerRequest $request){

        $images = $request->file('image');
        $img_paths = []; // 保存したパスを保持する配列

        DB::beginTransaction();
        try {
            // 画像が選択されているか確認
            if (!$request->hasFile('image')) {
                return back()->with('message', '画像を選択してください');
            }

            if($request->hasFile('image')){
                foreach($images as $image){
                    // 画像ファイルのファイル名を取得
                    $original = $image->getClientOriginalName();
                    // 日時をファイル名の前につける
                    $file_name = date('Ymd_His').'_'.$original;
                    // storage/app/public/images/bannerフォルダ内に、取得したファイル名で保存
                    $image->storeAs('public/images/banner', $file_name);
                    // データベース登録用に、ファイルパスを作成
                    $img_path = 'storage/images/banner/'.$file_name;
                    // データベース登録用のデータを追加
                    $img_paths[] = [
                        'image' => $img_path,
                        'created_at' => now(),
                        'updated_at' => now(),
                ];
            }
        }

        // まとめてデータベースに保存
            Banner::insert($img_paths);
            Log::info($img_paths);

            DB::commit();
            return back()->with('message', 'バナー画像を登録しました');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e);
            return back()->with('message', '正しく登録されませんでした');
            }
        }

        
        function deleteBanner ($id) {

            DB::beginTransaction();
            try {
                $banner = Banner::findOrFail($id);
                $banner->delete();
                DB::commit();
            } catch (\Exception $e) {
                
                DB::rollback();
                return back()->with('error', $e->getMessage('削除失敗！'));
            }

    }

}