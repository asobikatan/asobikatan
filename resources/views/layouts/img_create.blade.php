@extends($ua)

@section('title')
    画像の投稿| 日常をちょっと楽しく。
@endsection

@section('contents')
    @if($ua == 'objects.common')
        <a href="/">TOP</a> ＞　画像を投稿する
    @endif
    @isset($paths)
        @isset($pic_errors)
            <h2>1枚以上の投稿に成功しました！</h2>
            @foreach($pic_errors as $pic_error)
                <p class="error" style="padding: 5px;">"{{$pic_error}}"の投稿に失敗しました。</p>
            @endforeach
        @else
            <h2>すべての画像が投稿できました！</h2>
        @endif
        <p style="padding: 5px;">あそレポの投稿画面に戻り、それぞれのHTMLタグを任意の場所に貼り付けてください。</p>
        @php
            $i = 0;
        @endphp
        @foreach($paths as $path)
            <div class="clearfix img_create">
                <img style="width: 10%; float: left;" src="{{$path}}">
                <button class="misc-btn" onclick="copyToClipboard_{{$i}}()">タグをコピー</button>
                <input id="copyTarget{{$i}}" type="text" value='<img src="{{$path}}" style="width: 30%; float: right;">' readonly>
            </div>
            <script>
                function copyToClipboard_{{$i}}() {
                    // コピー対象をJavaScript上で変数として定義する
                    var copyTarget = document.getElementById("copyTarget{{$i++}}");
                    // コピー対象のテキストを選択する
                    copyTarget.select();
                    // 選択しているテキストをクリップボードにコピーする
                    document.execCommand("Copy");
                    // コピーをお知らせする
                    alert("コピーできました！ : " + copyTarget.value);
                }
            </script>
        @endforeach
    @else
        @isset($pic_errors)
            <h2 class="error">画像の投稿に失敗しました</h2>
        @endisset
    @endisset

    @if(count($errors) > 0)
        <p class="error" style="padding: 5px;">入力に問題があります。再度指定してください。</p>
        @foreach($errors->all() as $error)
            <p class="error" style="padding: 5px;">{{$error}}</p>
        @endforeach
    @endif
    <form action="/aso-repo/img-create" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="user_id" value="{{$session_user->id}}">
        <input type="hidden" name="aid" value="{{$aid}}">
        <input type="file" name="pics[]" multiple="multiple" accept="image/png, image/jpeg, image/gif">
        <p style="padding: 5px;">※20枚まで
        ※合計10MByteまで</p>

        <input type="image" src="/img/form/post4_btn.png" alt="送信する" align="middle" class="post_btn">
    </form>
@endsection

@section('side')
    @include('objects.ad')
    @include('objects.sns')
@endsection
