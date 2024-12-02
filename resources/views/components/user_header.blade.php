
<div>
    <a href="#" class="btn btn-secondary">時間割</a>
    <a href="#" class="btn btn-secondary">授業進捗</a>
    <a href="#" class="btn btn-secondary">プロフィール設定</a>

    <a href="{{ route('user.logout') }}" > ログアウト </a>

    <p>ユーザーネーム：{{ Auth::user()->name }}</p>
</div>