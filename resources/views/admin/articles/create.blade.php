@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 戻るボタン -->
    <div class="row mb-4">
        <div class="col">
            <a href="{{ route('admin.articles.index') }}" class="btn btn-link text-dark">
                ← 戻る
            </a>
        </div>
    </div>

    <h1 class="mb-4">お知らせ登録</h1>

    <form method="POST" action="{{ route('admin.articles.store') }}" class="bg-white p-4 rounded shadow-sm">
        @csrf

        <!-- 投稿日時 -->
        <div class="mb-3">
            <label class="form-label fw-bold">投稿日時</label>
            <input type="date" name="posted_date" class="form-control" required>
        </div>

        <!-- タイトル -->
        <div class="mb-3">
            <label class="form-label fw-bold">タイトル</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <!-- 本文 -->
        <div class="mb-3">
            <label class="form-label fw-bold">本文</label>
            <textarea name="article_contents" class="form-control" rows="4" required>{{ old('article_contents') }}</textarea>
        </div>

        <!-- 登録ボタン -->
        <div class="text-center">
            <button type="submit" class="btn btn-dark px-4 py-2">登録</button>
        </div>
    </form>

    <!-- エラーメッセージ表示 -->
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection