<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\BannerRequest;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Support\Facades\Log;
use Psy\Readline\Hoa\Console;

class BannerController extends Controller
{
    function showBannerEdit(){

        $banners = Banner::all();
        return view('admin.banner_edit', compact('banners'));
    }

    function saveBanners(BannerRequest $request){

        $image = $request->file('image');

        if($request->hasFile('image')){
            // 画像ファイルのファイル名を取得
            $original = $image->getClientOriginalName();
            // 日時をファイル名の前につける
            $file_name = date('Ymd_His').'_'.$original;
            // storage/app/public/images/bannerフォルダ内に、取得したファイル名で保存
            $image->storeAs('public/images/banner', $file_name);
            // データベース登録用に、ファイルパスを作成
            $img_path = 'storage/images/banner/'.$file_name;
        } else {
            $img_path = null;
        }
        
        // トランザクション開始
        DB::beginTransaction();
        try {
            Banner::create([
                'image' => $img_path
            ]);
            Log::info($image);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e);
            return back()->with('message', '正しく登録されませんでした');
            }
            return to_route('save.banners', compact('image'))->with('message', 'バナー画像を登録しました');
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