
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @vite(['resources/sass/app.scss','resources/sass/login.scss', 'resources/js/app.js'])


</head>
<body>

    <title>ログイン</title>


    <div class="container">

        <div class="register-link">
            <a href="{{ route('user.show.register') }}">新規会員登録はこちら</a>
        </div>

    <h1>ログイン</h1>
    <form method="POST" action="{{ route('user.show.login') }}" novalidate>
        @csrf

        
        <div class="form-group ">
            <label class="label" for="email" >メールアドレス</label>
                <input type="email" class="form-control" id="email" name="email" required>
                @error('email')
                <span class="alert alert-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
        </div>

        <div class="form-group ">
            <label class="label" for="password" >パスワード</label>
                <input type="password" class="form-control" id="password" name="password" required>
                @error('password')
                <span class="alert alert-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
        </div>

        <button type="submit" class="btn btn-primary">ログイン</button>
    </form>
    </div>
</body>
</html>
