@extends('user.layouts.app')

@section('title', 'トップページ')

@section('styles')
    @vite(['resources/sass/app.scss', 'resources/sass/top.scss'])
@endsection


@section('content')
    

    <!-- バナー画像の表示 -->
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($banners as $index => $banner)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset($banner->image) }}" alt="バナー画像" style="max-width: 80%; height: auto;">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">前へ</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">次へ</span>
                </button>
                <!-- インジケーターの追加 -->
                <div class="carousel-indicators">
                    @foreach ($banners as $index => $banner)
                        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- お知らせの表示 -->
    <div class="notification-container mt-4 "> 
    <h2 class="article mb-2 news-heading">お知らせ</h2> <!-- mb-2で下のマージンを調整 -->
    <ul class="list-group">
        @foreach ($articles as $article)
            <li class="list-group-item">
                <a href="{{ route('user.show.top', $article->id) }}" class="d-flex  text-start">
                <span class="text-muted">
                    @if($article->posted_date)
                        {{ $article->posted_date->format('Y年m月d日')}}
                    @else
                        日付なし
                    @endif
                    </span>
                <span>{{ $article->title }}</span>
                </a>
            </li>
        @endforeach
    </ul>
@endsection
