<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Carbon\Carbon;
use App\Http\Requests\StoreArticleForm;
use Illuminate\Support\Facades\DB;


class ArticleController extends Controller
{
    // お知らせ一覧画面
    public function showArticleList()
    {
        $articles = Article::all();
        foreach ($articles as $article) {
            $article->formatted_posted_date = Carbon::parse($article->posted_date)->format('Y年m月d日');
        }
        return view('admin.articles.index', compact('articles'));
    }

    // お知らせ登録画面
    public function showArticleCreate()
    {
        return view('admin.articles.create');
    }

    // お知らせ登録処理
    public function store(StoreArticleForm $request)
    {
        DB::beginTransaction();
        try {
            $request['posted_date'] = Carbon::parse($request['posted_date'])->format('Y-m-d H:i:s');
            Article::create($request->validated());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        return redirect()->route('admin.articles.index')->with('success', 'お知らせを登録しました');
    }

    // お知らせ編集画面
    public function showArticleEdit($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    // お知らせ更新処理
    public function update(StoreArticleForm $request, $id)
    {
        DB::beginTransaction();
        try {
            Article::articleUpdate($request, $id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        return redirect()->route('admin.articles.index')->with('success', 'お知らせを更新しました');
    }

    // お知らせ削除
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'お知らせを削除しました');
    }
}