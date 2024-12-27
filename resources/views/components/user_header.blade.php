
<div>
    <a href="#" class="btn btn-secondary">時間割</a>
    <a href="#" class="btn btn-secondary">授業進捗</a>
    <a href="#" class="btn btn-secondary">プロフィール設定</a>

    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-primary">ログアウト</button>
    </form>

    <p>ユーザーネーム：{{ Auth::user()->name }}</p>

</div>