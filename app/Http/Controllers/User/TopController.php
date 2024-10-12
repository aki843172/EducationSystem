<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Article;

class TopController extends Controller
{
    public function showTop()
    {
        $banners = Banner::all();
        $articles = Article::orderBy('posted_date', 'desc')->get();
        
        return view('user.top', compact('banners', 'articles'));
    }
}
