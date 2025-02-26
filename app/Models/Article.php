<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'posted_date', 'article_contents'];

    public static function articleUpdate($request, $id)
    {
        $article = self::findOrFail($id); 
        $article->posted_date = Carbon::parse($request['posted_date'])->format('Y-m-d H:i:s'); 
        $article->title = $request->title; 
        $article->article_contents = $request->article_contents; 
        $article->save();
    }
}
