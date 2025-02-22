@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 戻るボタンと新規登録ボタン -->
    <div class="row justify-content-between align-items-center mb-4">
        <div class="col-auto">
            <a href="#" class="btn btn-link text-dark"><i class="bi bi-arrow-left"></i> 戻る</a>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">新規登録</a>
        </div>
    </div>

    <h1 class="mb-4">お知らせ一覧</h1>

    <!-- テーブルのデザイン -->
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>投稿日時</th>
                    <th>タイトル</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->formatted_posted_date }}</td>
                        <td>{{ $article->title }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-info btn-sm">変更する</a>
                            <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection