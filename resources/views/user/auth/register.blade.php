<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @vite(['resources/sass/app.scss', 'resources/sass/register.scss', 'resources/js/app.js'])
   
</head>
<body>



<div class="container">
    <h1>新規会員登録</h1>
    <form method="POST" action="{{ route('user.show.register') }}"novalidate>
        @csrf


        <div class="login-link">
            <a href="{{ route('user.show.login') }}">ログインはこちら</a>
        </div>
        <div class="form-group">
            <label class="label" for="name">ユーザーネーム</label>
            <input type="text" id="name" name="name" class="form-control" required autofocus>
            @error("name")
            <span class="alert alert-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="label" for="name_kana">カナ</label>
            <input type="text" id="name_kana" name="name_kana" class="form-control" required autofocus>
            @error("name_kana")
            <span class="alert alert-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="label" for="email">メールアドレス</label>
            <input type="email" id="email" name="email" class="form-control" required>
            @error("email")
            <span class="alert alert-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="label" for="password">パスワード</label>
            <input type="password"  id="password" name="password" class="form-control" required>
            @error("password")
            <span class="alert alert-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="label" for="password_confirmation">パスワード確認</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            @error("password_confirmation")
            <span class="alert alert-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-register">登録</button>
    </form>
</div>

</body>
</html>