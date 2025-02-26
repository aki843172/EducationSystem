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
}
