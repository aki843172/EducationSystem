@extends('user.layouts.app')

@section('title', '配信ページ')

@section('content')
    <h1>{{ $curriculum->title }}</h1>
    <p>{{ $curriculum->description }}</p>

    @if ($curriculum->isAvailable()) <!-- 配信が可能かどうかのチェック -->
        <video controls>
            <source src="{{ $curriculum->video_url }}" type="video/mp4">
            お使いのブラウザは動画タグに対応していません。
        </video>
    @else
        <p>この動画は現在配信されていません。</p>
    @endif

    <a href="{{ route('user.show.curriculum') }}">授業一覧に戻る</a>
@endsection
