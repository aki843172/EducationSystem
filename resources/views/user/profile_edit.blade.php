@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 戻るボタン -->
    <div class="row mb-4">
        <div class="col">
            <a href="{{ route('user.show.top') }}" class="btn btn-link text-dark">← 戻る</a>
        </div>
    </div>

    <h1 class="mb-4 fw-bold">プロフィール変更</h1>

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

    <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        @csrf

        <div class="row">
            <!-- プロフィール画像 -->
            <div class="col-md-4 text-center">
                <img src="{{ asset('storage/' . ($user->profile_image ?? 'images/default.png')) }}" alt="プロフィール画像" class="profile-img rounded-circle">
                <div class="mt-2">
                    <label for="profile_image" class="form-label">プロフィール画像</label>
                    <input type="file" id="profile_image" name="profile_image" class="form-control">
                </div>
            </div>

            <!-- フォームエリア -->
            <div class="col-md-8">
                <!-- ユーザー名 -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">ユーザーネーム</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                </div>

                <!-- カナ -->
                <div class="mb-3">
                    <label for="kana" class="form-label fw-bold">カナ</label>
                    <input type="text" id="kana" name="name_kana" value="{{ old('name_kana', $user->name_kana) }}" class="form-control">
                </div>

                <!-- メールアドレス -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">メールアドレス</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                </div>

                <!-- パスワード（変更する場合のみ） -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">パスワード（変更する場合のみ）</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>

                <!-- パスワード確認 -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-bold">パスワード確認</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                </div>
            </div>
        </div>

        <!-- 登録ボタン -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-danger px-4 py-2">登録</button>
        </div>
    </form>
</div>
@endsection