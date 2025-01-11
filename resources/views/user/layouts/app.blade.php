<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <!-- Bootstrap 4.6.2 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-orange">
        <div class="container">
        
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-green text-white" href="{{ Auth::check() ? route('user.show.curriculum') : route('user.show.login') }}">
                            時間割
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-green text-white" href="{{ Auth::check() ? route('user.show.progress') : route('user.show.login') }}">
                            授業進捗
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-green text-white" href="{{ Auth::check() ? route('user.show.profile') : route('user.show.login') }}">
                            プロフィール設定
                        </a>
                    </li>
                </ul>
                <div class="ms-auto">
                    @auth
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                            class="check-btn btn logout-btn">
                            ログアウト
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('user.show.login') }}" class="check-btn btn login-btn">
                            ログイン
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    <div class="container mt-3">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
