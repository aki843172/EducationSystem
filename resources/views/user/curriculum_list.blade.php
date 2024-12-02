@extends('layouts.app')

@extends('components.user_header')

@section('content')
<div class="text-center">
    <a href="{{ route('show.curriculum') }}">←戻る</a>

        <!-- メッセージ表示 -->
        @if(session('message'))
        <x-message :message="session('message')" />
        @endif

    <div class="content-wrap">
        <div class="d-flex">
            <button id="goBack" class="btn btn-secondary">◀︎</button>
            <div class="currentDate">{{ $currentYear .'年'. $currentMonth .'月'}}</div>
            <button id="goNext" class="btn btn-secondary">▶︎</button>
        </div>

            <div class="d-flex">
                <div class="col-sm-4">

                    <!-- 各ボタンを押すと、指定した学年の時間割が表示される（初期表示はログインユーザーの学年のもの） -->
                    <!-- 学年・表示期間と現在の日時に当てはまるデータを取得する -->
                    <button type="button" data-id="1" class="btn btn-info btn-grade">小学校1年生</button>
                    <button type="button" data-id="2" class="btn btn-info btn-grade">小学校2年生</button>
                    <button type="button" data-id="3" class="btn btn-info btn-grade">小学校3年生</button>
                    <button type="button" data-id="4" class="btn btn-info btn-grade">小学校4年生</button>
                    <button type="button" data-id="5" class="btn btn-info btn-grade">小学校5年生</button>
                    <button type="button" data-id="6" class="btn btn-info btn-grade">小学校6年生</button>
                    <button type="button" data-id="7" class="btn btn-success btn-grade">中学校1年生</button>
                    <button type="button" data-id="8" class="btn btn-success btn-grade">中学校2年生</button>
                    <button type="button" data-id="9" class="btn btn-success btn-grade">中学校3年生</button>
                    <button type="button" data-id="10" class="btn btn-primary btn-grade">高校1年生</button>
                    <button type="button" data-id="11" class="btn btn-primary btn-grade">高校2年生</button>
                    <button type="button" data-id="12" class="btn btn-primary btn-grade">高校3年生</button>
                </div>

                <div class="curriculum-list col-sm-8">
                @foreach($result as $curriculum)
                    <a class="curriculum-item border border-secondary border-2 d-inline-flex">
                        <span>
                        </span>
                        <span class="curriculum-item-title">
                            {{ $curriculum->title }}
                        </span>
                        <span class="curriculum-item-schedule">
                            {{ $curriculum->description }}
                        </span>
                    </a>
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
    
    // 今の月
    var currentMonth = new Date().getMonth()+1;


    // 学年ボタンを押した時
    $(function(){
        $('.btn-grade').on('click',function(e){
            // $(document).on('click',".btn-grade",function(e){

            e.preventDefault();
            $('.curriculum-item').remove();

            // 選択した学年を代入
            // var clickEle = $(this);
            // var grade_id = clickEle.attr('id');
            var grade_id = $(this).attr('data-id');
            console.log('学年は'+grade_id+'です');


            // ajax処理
            $.ajax({
                type: 'GET',
                url: 'user/curriculum_list/'+grade_id,
                dataType: 'json',
                data: { 'id':grade_id,
                    'method': 'GET'
                 } //値をControllerへ渡す
                })

            // 成功した場合
                .done(function(data) {

                // オブジェクトから絞り込みデータを一つずつ取り出す
                $.each(data,
                    function(index, val) {

                    //  一覧表示する
                    $('.curriculum-item').append
                    (
                    // '<span>' + '<img src="/public/'+ val.thumbnail +'" alt="サムネイル" width="100">' + '</span>'+
                    '<span>' + val.title + '</span>'+
                    '<span>' + val.description + '</span>'
                    )
                 }
                )
                 })
        
            //失敗したとき
            .fail(function(){
                console.log('失敗です！');
            });
        
        })
    })

    // 右矢印のボタンを押した時
    $(function(){
        // $('#goNext').on('click', function(e){
        $(document).on('click',"#goNext",function(e){
            e.preventDefault();
            $('.curriculum-item').remove();

            // $('.currentData').empty();
            // $('.curriculum-item').append タグ内にdateを入れる

                //月遷移用 仮学年
                var grade = 1;


            // currentMonthが12だったら、ボタンを無効にする
            if(currentMonth === 12){
                alert('最終月です');
                $('#goNext').prop("disabled", true);
            }
            // currentMonthが1〜11だったら、+1する
            else if(1 <= currentMonth <= 11){
                currentMonth += 1;
                $('#goBack').prop("disabled", false);
            }

            $.ajax({
                type: 'GET',
                url: 'curriculum_list/month/'+currentMonth,
                dataType: 'json',
                data: { 'date':currentMonth,
                        'grade_id': grade
                 } //値をControllerへ渡す
                })

            // 成功した場合
                .done(function(data) {

                // オブジェクトから絞り込みデータを一つずつ取り出す
                $.each(data,
                    function(index, val) {

                    //  一覧表示する
                    $('.curriculum-item').append
                    (
                    '<span>' + '<img src="/public/'+ val.thumbnail +'" alt="サムネイル" width="100">' + '</span>'+
                    '<span>' + val.title + '</span>'+
                    '<span>' + val.description + '</span>'
                    )
                 }
                )
                 })
        
            //失敗したとき
            .fail(function(){
                console.log('失敗です！');
            });
            
            });
    })

    // 左矢印のボタンを押した時
    $(function(){
        $('#goBack').on('click', function(e){
            e.preventDefault();
            $('.curriculum-item').remove();

            // currentMonthが1だったら、ボタンを無効にする
            if(currentMonth === 1){
                alert('最初の月です');
                $('#goBack').prop("disabled", true);
            }
            // currentMonthが2〜12だったら、-1する
            else if(2 <= currentMonth <= 12){
                currentMonth -= 1;
                $('#goNext').prop("disabled", false);
            }

                //月遷移用 仮学年
                var grade = 1;


            $.ajax({
                type: 'GET',
                url: 'curriculum_list/month/'+currentMonth,
                dataType: 'json',
                data: { 'date':currentMonth,
                    'grade_id': grade } //値をControllerへ渡す
                })

            // 成功した場合
                .done(function(data) {

                // オブジェクトから絞り込みデータを一つずつ取り出す
                $.each(data,
                    function(index, val) {

                    //  一覧表示する
                    $('.curriculum-item').append
                    (
                    '<span>' + '<img src="/public/'+ val.thumbnail +'" alt="サムネイル" width="100">' + '</span>'+
                    '<span>' + val.title + '</span>'+
                    '<span>' + val.description + '</span>'
                    )
                 }
                )
                 })
                 
            //失敗したとき
            .fail(function(){
                console.log('失敗だー！');
            });
            
            
            });
        });
</script>

@endsection