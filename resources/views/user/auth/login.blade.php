


    <title>ログイン</title>


<div class="container">
    <h2>ログイン</h2>
    <form method="POST" action="{{ route('user.show.login') }}" novalidate>
        @csrf

        <div>
            <a href="{{ route('user.show.register') }}">新規会員登録はこちら</a>
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" required>
            @error('email')
            <span class="alert alert-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
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
