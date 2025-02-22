<?php

namespace App\Http\Controllers\User;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class ArticleController extends Controller
{
    public function show($id) {
        $article = Article::find($id); 
        return view('articles.show', compact('article'));
    }

    public function create() {
        return view('articles.create'); // 新規作成画面を表示
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'posted_date' => 'required|date',
            'article_contents' => 'required',
        ]);

        Article::create($validated); // お知らせを保存
        return redirect()->route('articles.index');
    }

    public function edit($id) {
        $article = Article::findOrFail($id); // 特定のお知らせを取得
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'posted_date' => 'required|date',
            'article_contents' => 'required',
        ]);

        $article = Article::findOrFail($id);
        $article->update($validated); // お知らせを更新
        return redirect()->route('articles.index');
    }

    public function destroy($id) {
        $article = Article::findOrFail($id);
        $article->delete(); // お知らせを削除
        return redirect()->route('articles.index');
    }
}
