<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Carbon\Carbon;

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
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'posted_date' => 'required|date',
        'title' => 'required|string|max:255',
        'article_contents' => 'required|string',
    ]);

    $validatedData['posted_date'] = Carbon::parse($validatedData['posted_date'])->format('Y-m-d H:i:s');
    Article::create($validatedData);
    return redirect()->route('admin.articles.index')->with('success', 'お知らせを登録しました');
}

    // お知らせ編集画面
    public function showArticleEdit($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    // お知らせ更新処理
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'posted_date' => 'required|date',
        'title' => 'required|string|max:255',
        'article_contents' => 'required|string',
    ]);

    $article = Article::findOrFail($id);
    $article->posted_date = Carbon::parse($validatedData['posted_date'])->format('Y-m-d H:i:m'); 
    $article->title = $request->title; 
    $article->article_contents = $request->article_contents; 
    $article->save();

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