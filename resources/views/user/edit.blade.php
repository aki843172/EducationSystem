@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 戻るボタン -->
    <div class="row mb-4">
        <div class="col">
            <a href="#" class="btn btn-link text-dark">← 戻る</a>
        </div>
    </div>

    <h1 class="mb-4 fw-bold">パスワード変更</h1>

    <!-- 成功メッセージ -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- エラーメッセージ -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('user.password.update') }}" class="bg-white p-4 rounded shadow-sm">
        @csrf

        <!-- 旧パスワード -->
        <div class="mb-3">
            <label for="current_password" class="form-label fw-bold">旧パスワード</label>
            <input type="password" id="current_password" name="current_password" class="form-control" required>
        </div>

        <!-- 新パスワード -->
        <div class="mb-3">
            <label for="new_password" class="form-label fw-bold">新パスワード</label>
            <input type="password" id="new_password" name="new_password" class="form-control" required>
        </div>

        <!-- 新パスワード確認 -->
        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label fw-bold">新パスワード確認</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
        </div>

        <!-- 登録ボタン -->
        <div class="text-center">
            <button type="submit" class="btn btn-danger px-4 py-2">登録</button>
        </div>
    </form>
</div>
@endsection