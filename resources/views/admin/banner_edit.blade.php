@extends('layouts.app')

@extends('components.admin_header')

@section('content')

<div>
    <!-- view: admin/topへ戻る -->
    <a href="{{ route('show.top') }}">←戻る</a>

    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <h1>バナー管理</h1>
        <div class="bannerslist-wrap">
            <ul class="bannerslist-table">

                @foreach($banners as $banner)
                <!-- 【作成期日:11/17】空の1行を作成する -->
                <li class="bannerslist-row">

                    <!-- 【作成期日:11/17】table:bannersに登録済のimageがあれば、上記の上に表示する -->
                    <label for="image" class="form-label w-25"></label>
                    <input id="image" type="file" name="image" class="form-control">
                    
                    <!-- 指定行削除ボタン -->
                    <button data-user_id="{{ $product->id }}" type="submit" class="bannerslist-delete">削除</button>
                </li>
                @endforeach
                
                <!-- 行追加ボタン -->
                <button class="bannerslist-add">
                    <span>+</span>
                </button>

            </ul>
        </div>

        <!-- バナー登録ボタン -->
        <button type="submit" class="bannerslist-save">登録</button>
    </form>
</div>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    // 行追加機能
    $(function(){
        $(document).on('click','.bannerslist-add',function(){
            $('.bannerslist-table').append
                ('<li class="bannerslist-row">' +
                    //'<img src="/public/'+ val.img_path +'" alt="初期画像" width="100">' +
                    '<button>ファイルを選択</button>' +
                    '<button><img src="" alt="削除ボタン" class="bannerslist-delete"></button>' +
                    '</li>');
        })
    })

    // 行削除機能
    $(function(){
        $(document).on('click','.bannerslist-delete', function(){
            var deleteConfirm = confirm('選択した行を削除しますか？');

            if(deleteConfirm == true){
                var clickEle = $(this);
                var ID = clickEle.attr('data-id');

                // Ajaxリクエストが行われるたびに、URLと他が自動的に使用される
                $.ajax({
                        type: 'POST',
                        url: 'destroy/'+ID,
                        data: {'id': ID,
                                '_method': 'DELETE'}
                        })
                        .done(function() {
                            // 通信が成功したら、クリックした要素の親要素の <tr> を削除
                            clickEle.parents('tr').remove();
                        })

                        } else {
                            
                        (function(e) {
                        e.preventDefault() // 元々の処理を無効化
                });
            };
        });
    });
</script>
@endsection