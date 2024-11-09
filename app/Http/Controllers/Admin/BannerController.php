<?php

// バナー画像はユーザートップページに表示させる画像
// 授業カリキュラムのサムネイルとは別物

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;

class BannerController extends Controller
{
    function showBannerEdit(){

        $banners = Banner::all();
        return view('admin.banner_edit', compact('banners'));
        
    }
        // 【作成期日:11/17】
        // function saveBanners(Request $request){
            // $banners = Banner::all();
            // $banners->fill($request->all())->save();
            // $banners->image = $request->input('thumbnails);

            // トランザクション
            // DB::beginTransaction();
            // try {
            //     $banners->thumbnail= $thumbnail;
            //     $banners->save();

            //     DB::commit();
            // } catch (\Exception $e) {
            //     DB::rollback();
            //     return back()->with('message', '正しく保存されませんでした');
        // }

}