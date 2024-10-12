@extends('user.layouts.app')

@section('content')

    
    <section id="banners">
    <h2>バナー画像</h2>
        @foreach ($banners as $banner)
            <img src="{{ asset('storage/images/banner/' . $banner->image) }}" alt="バナー画像">
        @endforeach
    </section>
    
    <section id="articles">
        <h2>お知らせ</h2>
        <ul>
            @foreach ($articles as $article)
                <li>
                    <a href="{{ route('user.article', $article->id) }}">{{ $article->title }}</a>
                </li>
            @endforeach
        </ul>
    </section>
@endsection
