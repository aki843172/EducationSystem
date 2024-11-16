<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 100px; 
           
            color: gray;
        }
        .container {
           
            max-width: 600px; /* 最大幅を設定 */
            padding: 10px;
        }

        h1 {
            text-align: center; /* 中央揃え */
            font-size: 50px; /* フォントサイズを大きく */
            margin-bottom: 80px; /* 下にマージンを追加 */
        }

        .login-link {
            color: gray;
            position: absolute;
            top: 100px; /* 上からの位置 */
            right: 500px; /* 右からの位置 */
        }

        .form-group {
            display: flex; /* Flexboxを使用 */
            justify-content: center; /* 中央に配置 */
            margin-bottom: 30px; /* 下にマージンを追加 */
           
            
        }
        .label {
            text-align: right;/* 右揃え */
            margin-right: 30px; /* ラベルと入力フィールドの間に余白を追加 */
            width: 300px; /* ラベルの横幅を広げる */
        }
        
        .btn-register {
            font-size: 30px;
            background-color: #FF5733; /* 背景色をオレンジに */
            border-color: #FF5733; /* ボーダー色をオレンジに */
            color: white; /* 文字色を白に */
            width: 200px; /* ボタンを幅いっぱいに */
            margin: 0 auto; /* 中央揃え */
            display: block; /* ブロック要素にする */
        }

        .alert-danger {
            font-size: 10px;/* フォントサイズを小さくする */
            line-height: 1; /* 行の高さを調整 */
            white-space: nowrap; /* テキストを折り返さない */
        }

        
    </style>
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