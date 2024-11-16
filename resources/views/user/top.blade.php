@extends('user.layouts.app')

@section('title', 'トップページ')

@section('content')
    <div class="banner">
        <img src="{{ asset('storage/images/banner/banner1.jpg') }}" alt="バナー画像">
        <!-- バナー切り替えボタン -->
        <button id="change-banner">...</button>
    </div>

    <div class="notifications">
        <h2>お知らせ</h2>
        <ul>
            @foreach($articles as $article)
                <li>
                <a href="{{ route('user.article', ['id' => $article->id]) }}">
                        {{ $article->title }} ({{ $article->posted_date->format('Y/m/d') }})
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    
 
    <script>
        let currentIndex = 0;
        const banners = document.querySelectorAll('.banner-image');

        function changeBanner(direction) {
            banners[currentIndex].style.display = 'none'; // 現在のバナーを非表示に
            currentIndex = (currentIndex + direction + banners.length) % banners.length; // 新しいインデックスを計算
            banners[currentIndex].style.display = 'block'; // 新しいバナーを表示
        }
    </script>


@endsection
