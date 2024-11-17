
<div class="text-end">
    <a href="#" class="btn btn-secondary">授業管理</a>
    <a href="#" class="btn btn-secondary">お知らせ管理</a>
    <a href="banner_edit" class="btn btn-secondary">バナー管理</a>

        <a class="dropdown-item btn btn-warning" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('ログアウト') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
</div>