
<div>
    <a href="#" class="btn btn-secondary">時間割</a>
    <a href="#" class="btn btn-secondary">授業進捗</a>
    <a href="#" class="btn btn-secondary">プロフィール設定</a>

        <a class="dropdown-item btn btn-warning" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('ログアウト') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
</div>