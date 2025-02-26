<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    // プロフィール編集画面を表示
    public function edit()
    {
        $user = Auth::user(); // 現在のログインユーザーを取得
        return view('user.profile_edit', compact('user'));
    }

    // プロフィール情報を更新
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'name_kana' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction(); // トランザクション開始
        try {
            // プロフィール画像の処理
            if ($request->hasFile('profile_image')) {
                if ($user->profile_image) {
                    Storage::delete($user->profile_image); // 古い画像を削除
                }
                $path = $request->file('profile_image')->store('profile_images', 'public');
                $user->profile_image = $path;
            }

            // その他のプロフィール情報を更新
            $user->name = $request->name;
            $user->name_kana = $request->name_kana;
            $user->email = $request->email;

            // パスワードの更新（入力された場合のみ）
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save(); // データベース更新

            DB::commit(); // すべて成功したらコミット（確定）
        } catch (\Exception $e) {
            DB::rollBack(); // 失敗したらロールバック（データを元に戻す）
            return back()->withErrors(['error' => '更新に失敗しました。']);
        }
            }
}