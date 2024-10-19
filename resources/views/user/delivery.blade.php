@extends('user.layouts.app')

@section('title', '配信ページ')

@section('content')
    

    <h1>{{ $curriculum->title }}</h1>
    <p>{{ $curriculum->description }}</p>

    @if ($isAvailable)
        <video controls>
            <source src="{{ $curriculum->video_url }}" type="video/mp4">
            お使いのブラウザは動画タグに対応していません。
        </video>
        
        @if ($progress && $progress->clear_flg === 0)
            <form action="{{ route('user.progress') }}" method="POST">
                @csrf
                <input type="hidden" name="curriculum_id" value="{{ $curriculum->id }}">
                <button type="submit">受講しました</button>
            </form>
        @else
            <p>受講済み</p>
        @endif
    @else
        <p>この動画は現在配信されていません。</p>
    @endif

    <a href="{{ route('user.show.curriculum') }}">戻る</a>
@endsection
