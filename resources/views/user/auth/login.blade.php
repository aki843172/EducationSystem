
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
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
            width: 100%;
            max-width: 600px; /* 最大幅を設定 */
            padding: 20px;
        }

        h1 {
            text-align: center; /* 中央揃え */
            font-size: 50px; /* フォントサイズを大きく */
            margin-bottom: 80px; /* 下にマージンを追加 */
        }

        .register-link {
            color: gray;
            position: absolute;
            top: 100px; /* 上からの位置 */
            right: 500px; /* 右からの位置 */
        }

        .form-group {
            display: flex; /* Flexboxを使用 */
            margin-bottom: 50px; /* 下にマージンを追加 */
           
            
        }
        .label {
            text-align: right;/* 右揃え */
            margin-right: 30px; /* ラベルと入力フィールドの間に余白を追加 */
            min-width: 120px; /* ラベルの幅を固定 */
        }
        
        .btn-primary {
            font-size: 30px;
            background-color: #FF5733; /* 背景色をオレンジに */
            border-color: #FF5733; /* ボーダー色をオレンジに */
            color: white; /* 文字色を白に */
            width: 200px; /* ボタンを幅いっぱいに */
            margin: 0 auto; /* 中央揃え */
            display: block; /* ブロック要素にする */
        }

        
    </style>
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
