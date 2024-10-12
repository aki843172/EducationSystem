
<title>新規会員登録</title>


<div class="container">
    <h2>新規会員登録</h2>
    <form method="POST" action="{{ route('user.show.register') }}"novalidate>
        @csrf


        <div>
            <a href="{{ route('user.show.login') }}">ログインはこちら</a>
        </div>
        <div class="form-group">
            <label for="name">ユーザーネーム</label>
            <input type="text" id="name" name="name" class="form-control" required autofocus>
            @error("name")
            <span class="alert alert-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="name_kana">カナ</label>
            <input type="text" id="name_kana" name="name_kana" class="form-control" required autofocus>
            @error("name_kana")
            <span class="alert alert-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" class="form-control" required>
            @error("email")
            <span class="alert alert-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password"  id="password" name="password" class="form-control" required>
            @error("password")
            <span class="alert alert-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            @error("password_confirmation")
            <span class="alert alert-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
</div>

