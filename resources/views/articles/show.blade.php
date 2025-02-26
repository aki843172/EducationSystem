@extends('layouts.app')

@section('content')

<div class="container">
    <!-- 戻るボタン -->
    <div class="row mb-4">
        <div class="col">
            <a href="{{ route('user.top') }}" class="btn btn-link text-dark">
                ← 戻る
            </a>
        </div>
    </div>

    <!-- お知らせ詳細 -->
    <p class="text-muted fs-5">{{ \Carbon\Carbon::parse($article->posted_date)->format('Y年m月d日') }}</p>

    <h1 class="fw-bold">{{ $article->title }}</h1>

    <p class="mt-3 lh-lg">
        {{ nl2br(e($article->article_contents)) }}
    </p>
</div>

@endsection