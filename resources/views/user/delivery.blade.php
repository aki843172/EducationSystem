
@extends('user.layouts.app')

@section('title', '配信ページ')

@section('styles')
    @vite(['resources/sass/app.scss', 'resources/sass/delivery.scss'])
@endsection

@section('content')
    @if(Auth::check())
        認証済み：{{ Auth::user()->name }}
    @else
        未認証
    @endif

<div class=" container">
    <!-- 戻るボタン -->
    <div class="delivery-page mb-4">
        <a href="{{ route('user.show.top') }}" class="delivery-page__btn delivery-page__btn--back">←戻る</a>
    </div>

            <!-- 動画エリア -->
    <div class="delivery-page__content">
        <div class="delivery-page__video">
            @if ($canShowVideo)
                <video src="{{ asset($curriculum->video_url) }}" controls style="max-width: 50%; height: auto;"></video>
            @else
                @if (isset($banner) && $banner)
                
                    <img src="{{ asset($banner->image) }}" alt="バナー画像" style="max-width: 80%; height: auto;">
                @else
                    <p>バナー画像がありません。</p>
            @endif

            @endif
        </div>
    
            <!-- 受講ボタンエリア -->
        <div class="delivery-page__button-area" id="completion-status">
            @if($canShowCompleteButton)
                <button type="button" class="delivery-page__btn delivery-page__btn--complete" id="complete_button" 
                        data-delivery-id="{{ $curriculum->id }}">    
                    受講しました
                </button>
            @elseif ($progress && $progress->clear_flg == 1)
                <span class="text-success">受講済み</span>
            @else
                <p>この動画はまだ受講できません。</p>
            @endif
        </div>
    </div>

    <div class="curriculum-content">
        <!-- 学年 -->
        <div class="curriculum-content__grade mb-4">
            {{ $curriculum->grade->name }}
        </div>

        <!-- タイトル -->
        <h1 class="curriculum-content__title mb-4">{{ $curriculum->title }}</h1>

        <!-- 概要 -->
        <div class="curriculum-content__description mb-4">
            <p>{{ $curriculum->description }}</p>
        </div>

        
    </div>   
@endsection

@push('scripts')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/app.js', 'resources/js/delivery/delivery-complete.js'])
@endpush