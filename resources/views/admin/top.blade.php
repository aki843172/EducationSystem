
@extends('layouts.app')

<!-- 管理者ページ用ヘッダー読込 -->
@extends('components.admin_header')

@section('content')
<div class="content-wrap">
    <ul>
        <!--【作成期日:11/17】ログインユーザー情報を表示 -->
        <li>ユーザーネーム：{{ __('名前') }}</li>
        <li>メールアドレス：{{ __('アドレス') }}</li>
    </ul>
</div>
@endsection