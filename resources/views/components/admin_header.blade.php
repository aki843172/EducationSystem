
<div class="text-end">
    <a href="#" class="btn btn-secondary">授業管理</a>
    <a href="#" class="btn btn-secondary">お知らせ管理</a>
    <a href="banner_edit" class="btn btn-secondary">バナー管理</a>

    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-primary">ログアウト</button>
    </form>
    <p>ユーザーネーム：{{ Auth::user()->name }}</p>

</div>