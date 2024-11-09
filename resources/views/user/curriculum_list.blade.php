@extends('layouts.app')

@extends('components.user_header')

@section('content')
<div>
    <a href="{{ route('show.curriculum') }}">←戻る</a>

    <div class="content-wrap">
        <button id="goBack" class="btn btn-secondary">◀︎</button>
        <div class="">{{__('西暦月スケジュール')}}</div>
            <button id="goNext" class="btn btn-secondary">▶︎</button>

            <!-- 【作成期日:11/17】 -->
            <div class="gd-button">{{__('ログインユーザーの学年表示')}}</div>
            <div class="curriculum-gradelist">

                <!-- 各ボタンを押すと、指定した学年の時間割が表示される（初期表示はログインユーザーの学年のもの） -->
                <!-- 学年・表示期間と現在の日時に当てはまるデータを取得する -->
                <button type="button" id="1" class="btn btn-info">小学校1年生</button>
                <button type="button" id="2" class="btn btn-info">小学校2年生</button>
                <button type="button" id="3" class="btn btn-info">小学校3年生</button>
                <button type="button" id="4" class="btn btn-info">小学校4年生</button>
                <button type="button" id="5" class="btn btn-info">小学校5年生</button>
                <button type="button" id="6" class="btn btn-info">小学校6年生</button>
                <button type="button" id="7" class="btn btn-success">中学校1年生</button>
                <button type="button" id="8" class="btn btn-success">中学校2年生</button>
                <button type="button" id="9" class="btn btn-success">中学校3年生</button>
                <button type="button" id="10" class="btn btn-primary">高校1年生</button>
                <button type="button" id="11" class="btn btn-primary">高校2年生</button>
                <button type="button" id="12" class="btn btn-primary">高校3年生</button>
            </div>

            <div class="curriculum-list">
            @foreach($curriculums as $curriculum)
                <div class="curriculum-item border border-secondary border-2 d-inline-flex">
                    <a href="">
                        {{ $curriculum->thumbnail }}
                    </a>
                    <a href="" class="curriculum-item-title">
                        {{ $curriculum->title }}
                    </a>
                    <a href="" class="curriculum-item-schedule">
                        {{ $curriculum->description }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    // 右矢印のボタンを押した時
    $(function(){
        $('#goNext').on('click', function(e){
            e.preventDefault();
            $('.curriculum-item').remove();

            // 現在の月を取得、currentMonthへ代入する
            const date = new Date();
            var currentMonth = date.getMonth() + 1;
            
            
            // currentMonthが12だったら、ボタンを無効にする
            if(currentMonth === 12){
                alert(currentMonth);
                $('#goNext').prop("disabled", true);
            }
            // currentMonthが1〜11だったら、+1する
            else if(1 <= currentMonth <= 11){
                currentMonth += 1;
            }

            // currentMonthと配信期間の月が合うカリキュラム情報を取得
            // $.ajax({
            //     type: 'GET',
            //     url: 'list/search',
            //     dataType: 'json',
            //     data: keywordValue //検索フォームの入力値をControllerへ渡す
            //     })

            // 一覧へ表示する
        })
    })

    // 左矢印のボタンを押した時
    $(function(){
        $('#goBack').on('click', function(e){
            e.preventDefault();
            $('.curriculum-item').remove();

            // 現在の月を取得、currentMonthへ代入する
            const date = new Date();
            var currentMonth = date.getMonth() + 1;

            // currentMonthが1だったら、ボタンを無効にする
            if(currentMonth === 1){
                $('#goBack').prop("disabled", true);
            }
            // currentMonthが2〜12だったら、-1する
            else if(2 <= currentMonth <= 12){
                currentMonth -= 1;
                alert(currentMonth);
            }

            // currentMonthと配信期間の月が合うカリキュラム情報を取得
            // 一覧へ表示する


            // $.ajax({
            //     type: 'GET',
            //     url: 'list/search',
            //     dataType: 'json',
                // data: keywordValue, //検索フォームの入力値をControllerへ渡す
                // type: 'POST', // HTTPリクエストメソッドの指定
                // url: '/bar/foo.txt', // 送信先URLの指定
                // async: true, // 非同期通信フラグの指定
                // dataType: 'json', // 受信するデータタイプの指定

                // })

                // 成功した場合
                // .done(function(data) {

                // オブジェクトから絞り込みデータを一つずつ取り出す
                // $.each(data,
                //     function(index, val) {

        // 検索結果をtbody内に追加する
        // $('.curriculum-item').append
        // (
        // '<span>' + '<img src="/public/'+ val.thumbnail +'" alt="サムネイル" width="100">' + '</span>'+
        // '<span>' + val.title + '</span>'+
        // '<span>' + val.description + '</span>'+
        // });

        // 失敗したとき
        // .fail(function(){
        //     console.log('該当するカリキュラムはありません');
        // });
        // });

        });
        });
</script>

@endsection