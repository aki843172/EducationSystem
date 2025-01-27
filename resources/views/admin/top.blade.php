
@extends('layouts.app')

@extends('components.admin_header')

@section('content')
<div class="content-wrap">
    
        <!-- メッセージ表示 -->
        @if(session('message'))
        <x-message :message="session('message')" />
        @endif

    <ul>
        <li>ユーザーネーム：{{ Auth::user()->name }}</li>
        <li>メールアドレス：{{ Auth::user()->email }}</li>
    </ul>
</div>
@endsection