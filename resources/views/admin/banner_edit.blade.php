@extends('layouts.app')

@extends('components.admin_header')

@section('content')

<div class="ms-4">
    <a href="{{ route('show.admin.top') }}">←戻る</a>

    <form action="{{ route('save.banners') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h1>バナー管理</h1>

        <!-- メッセージ表示 -->
        @if(session('message'))
        <x-message :message="session('message')" />
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bannerslist-wrap">
            <ul class="bannerslist-table">

            @if($banners->isNotEmpty())
                @foreach($banners as $banner)
                <li class="bannerslist-row list-unstyled bg-light">
                    <td><img src="{{ asset($banner->image) }}" alt="商品画像" width="100"></td>
                    <!-- 指定行削除ボタン -->
                    <button data-id="{{ $banner->id }}" class="bannerslist-delete">削除</button>
                </li>
                @endforeach
            @endif

                <!-- 行追加ボタン -->
                <button type="button" class="bannerslist-add">
                    <span>行追加+</span>
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
                ('<li class="bannerslist-row list-unstyled bg-light">' +
                    '<input id="image" type="file" name="image[]" class="form-control" multiple>' +
                    '<button data-id="" class="bannerslist-delete">削除</button>' +
                '</li>');
        })
    })


    // 行削除機能
    $(function(){
        $(document).on('click','.bannerslist-delete', function(e){
            e.preventDefault();
            var deleteConfirm = confirm('選択した行を削除しますか？');

            if(deleteConfirm == true){
                var clickEle = $(this);
                var ID = clickEle.attr('data-id');



                // Ajaxリクエストが行われるたびに、URLと他が自動的に使用される
                $.ajax({
                        type: 'POST',
                        url: 'banner_edit/destroy/'+ID,
                        data: {'id': ID,
                                '_method': 'DELETE'}
                }).done(function() {
                        console.log('成功');
                        // 通信が成功したら、クリックした要素の親要素の <tr> を削除
                        clickEle.parents('li').remove();
                    }).fail(function(error){ //なぜここにerrorを入れるのか
                        console.log(error);
                    })
                };
        });
    });
</script>
@endsection