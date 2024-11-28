
@extends('layouts.app')

@extends('components.admin_header')

@section('content')
<div class="content-wrap">
    <ul>
        <li>ユーザーネーム：{{ Auth::user()->name }}</li>
        <li>メールアドレス：{{ Auth::user()->email }}</li>
    </ul>
</div>
@endsection