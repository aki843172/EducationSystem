
<div class="text-end">
    <a href="#" class="btn btn-secondary">授業管理</a>
    <a href="#" class="btn btn-secondary">お知らせ管理</a>
    <a href="banner_edit" class="btn btn-secondary">バナー管理</a>

    <a href="{{ route('admin.logout') }}">ログアウト</a>
    <p>ユーザーネーム：{{ Auth::user()->name }}</p>

</div>