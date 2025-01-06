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
                <!-- 現在表示されている学年を表示 -->
                <div class="grade" data-id="{{ Auth::user()->grade_id }}">
                    <!-- 初期表示はログインユーザーの学年タイトルが入る -->

                </div>
                
                <div class="d-flex">
                    <button id="goBack" type="button" class="btn btn-secondary">◀︎</button>
                    <div class="currentDate">{{ $datetime->format('Y').'年'.$datetime->format('m').'月' }}</div>
                    <button id="goNext" type="button" class="btn btn-secondary">▶︎</button>
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
                @foreach($filteredCurriculums as $curriculum)
                    <a class="curriculum-item border border-secondary border-2 d-inline-flex">
                        <div class="curriculum-item-title">
                            {{ $curriculum->title }}
                        </div>
                        <div class="curriculum-item-schedule">
                            {{ $curriculum->description }}
                        </div>
                        <div>
                            {{ $curriculum->delivery_from }}
                        </div>
                        <div>
                            {{ $curriculum->delivery_to }}
                        </div>
                    </a>
                @endforeach
                </div>
            </div><!-- /content-wrap -->
    </div>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        // ページを表示した際に、学年IDを学年タイトルに変換する処理
        $(document).ready(function() {
            var grade = $('.grade').attr('data-id');
            if (grade) {
                grade = parseInt(grade, 10);
                var gradeTitle = getGradeName(grade);

                $('.grade').empty();
                $('.grade').append(gradeTitle);

            } else {
                // 取得できなかった場合
                console.log('学年が存在しません。');
            }
        });


    // 学年ボタンを押した時
    $(function(){
            $(document).on('click','.btn-grade',function(e){

            e.preventDefault();
            $('.curriculum-item').remove();

            // 現在の日付（例：2024年12月）を取得
            var currentDateTitle = $('.currentDate').text(); // "2024年12月"
            
            // 年月部分を「YYYY-MM」の形式に変換
            var currentDate = currentDateTitle.replace('年', '-').replace('月', ''); // "2024-12"

            // 選択した学年IDを代入
            var grade_id = $(this).attr('data-id');
            console.log('学年は'+grade_id+'です');

            // ajax処理
            $.ajax({
                type: 'GET',
                url: 'curriculum_list/'+grade_id+'/'+currentDate
            })

            // 成功した場合
                .done(function(data) {
                    console.log('成功です');
                    console.log(data);

                    // 学年表示を空にする
                    $('.grade').empty();
                    
                    // 学年タイトルを空にする
                    $('.grade').attr('data-id', '');

                    // 最小のindex番号を見つける変数
                    var minIndex = null;
                    var minGrade = null;


                // オブジェクトから絞り込みデータを一つずつ取り出す
                $.each(data.curriculums,
                    function(index, val) {

                    var grade = val.grade_id;

                    // 学年IDを学年タイトルに変換するための関数を呼び出す変数
                    var gradeName = getGradeName(grade);

                    // 最初のインデックスを取得する処理
                    if (minIndex === null || index < minIndex) {
                        minIndex = index;
                    }

                    // ループが終わった後、最小のインデックス番号の学年を表示
                    if (index === minIndex) {
                        $('.grade').append(gradeName);
                        $('.grade').attr('data-id', grade);
                    }

                    //  授業データを表示する
                    $('.curriculum-list').append
                    (
                    '<a class="curriculum-item border border-secondary border-2 d-inline-flex">'+
                        '<div class="curriculum-item-title">'+ val.title + '</div>'+
                        '<div class="curriculum-item-schedule">'+ val.description + '</div>'+
                        '<div>' + val.delivery_from + '</div>'+
                        '<div>'+ val.delivery_to + '</div>'+
                    '</a>'
                    )
                 })
                 })
        
            //失敗したとき
            .fail(function(){
                console.log('失敗です！');
            });
        
        })
    })


    // 右矢印のボタンを押した時
    $(function(){
        $(document).on('click','#goNext',function(e){
            e.preventDefault();
            $('.curriculum-item').remove();

            const clickId = ('#goNext');

                // 学年IDを取得する
                var grade = $('.grade').attr('data-id');
                // IDを数値に変換する
                grade = parseInt(grade, 10);

                // 表示されている年月日タイトルを取得
                var currentDateTitle = $('.currentDate').text();
                // 年月日タイトルの数字のみ取得
                var currentDate = currentDateTitle.replace('年', '-').replace('月', ''); // "2025-1"


            $.ajax({
                type: 'GET',
                url: 'curriculum_list/month/'+ grade +'/'+currentDate,
                data: { 'clickId':clickId }
                })

            // 成功した場合
                .done(function(data) { 
                    console.log('成功です');
                    console.log(data);

                    // 学年表示を空にする
                    $('.grade').empty();

                    // 最小のindex番号を見つける変数
                    var minIndex = null;
                    var minGrade = null;


                // オブジェクトから絞り込みデータを一つずつ取り出す
                $.each(data.curriculums,
                    function(index, val) {

                    var grade = val.grade_id;

                    // grade_idを学年へ変換するための関数を呼び出す変数
                    var gradeName = getGradeName(grade);

                    // 最初のインデックスを取得する処理（学年を1つだけ取得）
                    if (minIndex === null || index < minIndex) {
                        minIndex = index;
                    }

                    // ループが終わった後、最小のインデックス番号の学年を表示
                    if (index === minIndex) {
                        $('.grade').append(gradeName);
                        $('.grade').attr('data-id', grade);
                    }

                    // レスポンスを受け取って、1ヶ月進んだ年月を表示
                    var newDate = data.datetime; // "2025-01"
                    var yearMonth = newDate.replace('-', '年') + '月'; // "2025年01月"
                    $('.currentDate').text(yearMonth); // 新しい年月を表示


                    //  一覧表示する
                    $('.curriculum-list').append
                    (
                    '<a class="curriculum-item border border-secondary border-2 d-inline-flex">'+
                        '<div class="curriculum-item-title">'+ val.title + '</div>'+
                        '<div class="curriculum-item-schedule">'+ val.description + '</div>'+
                        '<div>' + val.delivery_from + '</div>'+
                        '<div>'+ val.delivery_to + '</div>'+
                    '</a>'
                    )
                 })
                 })

            //失敗したとき
            .fail(function(){
                console.log('失敗しました！');
            });
            
            }) 
    }) 

    // 左矢印のボタンを押した時
    $(function(){
        $('#goBack').on('click', function(e){
            e.preventDefault();
            $('.curriculum-item').remove();

            const clickId = ('#goBack');

                // 学年IDを取得する
                var grade = $('.grade').attr('data-id');
                // IDを数値に変換する
                grade = parseInt(grade, 10);

                // 表示されている年月日タイトルを取得
                var currentDateTitle = $('.currentDate').text();
                // 年月日タイトルの数字のみ取得
                var currentDate = currentDateTitle.replace('年', '-').replace('月', ''); // "2025-1"


            $.ajax({
                type: 'GET',
                url: 'curriculum_list/month/'+ grade +'/'+currentDate,
                data: { 'clickId':clickId }
                })

                // 成功した場合
                .done(function(data) { 
                    console.log('成功です');
                    console.log(data);

                    // 学年表示を空にする
                    $('.grade').empty();

                    // 最小のindex番号を見つける変数
                    var minIndex = null;
                    var minGrade = null;

                // オブジェクトから絞り込みデータを一つずつ取り出す
                $.each(data.curriculums,
                    function(index, val) {

                        var grade = val.grade_id;

                        // grade_idを学年タイトルへ変換するための関数を呼び出す変数
                        var gradeName = getGradeName(grade);

                        // 最初のインデックスを取得する処理（学年を1つだけ取得）
                        if (minIndex === null || index < minIndex) {
                            minIndex = index;
                        }

                        // ループが終わった後、最小のインデックス番号の学年を表示
                        if (index === minIndex) {
                            $('.grade').append(gradeName);
                            $('.grade').attr('data-id', grade);

                        }

                        // レスポンスを受け取って、1ヶ月戻った年月を表示
                        var newDate = data.datetime; // "2025-01"
                        var yearMonth = newDate.replace('-', '年') + '月'; // "2025年01月"
                        $('.currentDate').text(yearMonth); // 新しい年月を表示

                        //  一覧表示する
                        $('.curriculum-list').append
                        (
                        '<a class="curriculum-item border border-secondary border-2 d-inline-flex">'+
                            '<div class="curriculum-item-title">'+ val.title + '</div>'+
                            '<div class="curriculum-item-schedule">'+ val.description + '</div>'+
                            '<div>' + val.delivery_from + '</div>'+
                            '<div>'+ val.delivery_to + '</div>'+
                        '</a>'
                        )
                    })
                })

                //失敗したとき
                .fail(function(){
                    console.log('失敗しました！');
                });
            })
        })

        // 学年IDを学年タイトルに変換する関数
        function getGradeName(grade) {
            switch (grade) {
                case 1: return '小学1年生';
                case 2: return '小学2年生';
                case 3: return '小学3年生';
                case 4: return '小学4年生';
                case 5: return '小学5年生';
                case 6: return '小学6年生';
                case 7: return '中学1年生';
                case 8: return '中学2年生';
                case 9: return '中学3年生';
                case 10: return '高校1年生';
                case 11: return '高校2年生';
                case 12: return '高校3年生';
                default:
                    console.log('学年を取得できませんでした');
                    return null;
            }
        }

</script>

@endsection