@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-3 text-center"> <!--  大画面は12分割のうち3列分の幅を占めます（全体の1/4）。-->
        <div class="pull-right">
            <a class="btn" href="{{ url('/products') }}">←戻る</a>
        </div>
        <h1>授業一覧</h1>
        <button><a href="/">新規登録</a></button>
    </div>

    <div class="col-lg-9"> <!--  大画面は12分割のうち9列分の幅を占めます（全体の3/4）。-->
        <div class="row">
            <div class="col-12">0の箱</div>
        </div>
        <div class="row">
            <div class="col-4">1つ目の箱</div>
            <div class="col-4">2つ目の箱</div>
            <div class="col-4">3つ目の箱</div>
        </div>
        <div class="row">
            <div class="col-4">4つ目の箱</div>
            <div class="col-4">5つ目の箱</div>
            <div class="col-4">6つ目の箱</div>
        </div>
        <div class="row">
            <div class="col-4">7つ目の箱</div>
            <div class="col-4">8つ目の箱</div>
            <div class="col-4">9つ目の箱</div>
        </div>
    </div>
</div>
@endsection