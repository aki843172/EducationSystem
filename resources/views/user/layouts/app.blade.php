<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'トップページ')</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('user.show.curriculum') }}">時間割</a></li>
                <li><a href="{{ route('user.show.progress') }}">授業進捗</a></li>
                <li><a href="{{ route('user.show.profile') }}">プロフィール設定</a></li>
                @auth
                    <li><a href="{{ route('logout') }}">ログアウト</a></li>
                @else
                    <li><a href="{{ route('user.show.login') }}">ログイン</a></li>
                @endauth
            </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
