<!DOCTYPE html>
<html>
<head>
    <!-- 牛島一樹(2674je@gmail.com)が作りました -->
    <meta charset="utf-8">
    <style>
        body:after{
        	content: "";
        	clear: both;
        	display: block;
            width: 100%;
            height: 50px;
            margin: 0;
        }
        @if($ua == 'sp_objects.common')
            .misc-btn{
                display: inline-block;
                background: linear-gradient(#fff, #f0f0f0);
                border-radius: 10px;
                box-shadow:0px 0px 3px 3px #cfcfcf;
                text-decoration: none;
                color: black;
                text-align: center;
                vertical-align: middle;
            }
            input, button {
                width: 86%;
                margin: 5%;
                padding: 2%;
                border: 1px solid gray;
                border-radius: 10px;
                box-shadow: 0px 0px 1px 1px #ccc inset;
                line-height: 200%;
            }
            input[type="submit"]{
                color: inherit;
                width: 33%;
                float: left;
            }
            input[type="text"]{
                width: 42%;
            }
        @endif
    </style>
</head>

<body>
    @if(isset($pic_errors))
        <h2 class="error">画像の投稿に失敗しました</h2>
    @endif
    @if(isset($path))
        <h2>画像の投稿に成功しました。</h2>
        <p>任意の場所にタグを貼り付けて使用してください。<br>
            もっと画像が必要ですか？同じ操作を繰り返すことで、複数枚の画像を投稿できます。</p>
    @endif
    <form action="/aso-repo/img-create" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="user_id" value="{{$session_user->id}}">
        @if($ua == 'sp_objects.common')
            <input type="file" name="pics" accept="image/png, image/jpeg, image/gif">
            <br>
        @else
            <input type="file" style="width: 200px;" name="pics" accept="image/png, image/jpeg, image/gif">
        @endif
        <input class="misc-btn" type="submit" value="->画像を投稿->" onClick='disp_loading();'>
        @if(isset($path))
            <input id="copyTarget" type="text" value='<img src="{{$path}}" style="width: 30%; float: right;">'>
            @if($ua == 'sp_objects.common')
                <button class="misc-btn" id="copyButton">タグをコピー</button>
            @else
                <button class="misc-btn" onclick="copyToClipboard()">タグをコピー</button>
            @endif
        @else
            <input id="copyTarget" type="text" placeholder="ここにタグが出ます">
        @endif
        ※10MByteまで
        <!-- ↓ onClick='disp_loading();'を実現 -->
        @include('objects.loading')
    </form>
    @if($ua == 'sp_objects.common')
        <script>
            var button = document.getElementById('copyButton');
            button.addEventListener('click', function(){
                var copyTarget = document.getElementById('copyTarget');
                var range = document.createRange();
                range.selectNode(copyTarget);
                window.getSelection().addRange(range);
                document.execCommand('copy');
                alert("コピーできました！ : " + copyTarget.value);
            });
        </script>
        <!-- 参考：https://dev.classmethod.jp/smartphone/iphone/safari-cut-copy/ -->
    @else
        <script>
            function copyToClipboard() {
                // コピー対象をJavaScript上で変数として定義する
                var copyTarget = document.getElementById("copyTarget");
                // コピー対象のテキストを選択する
                copyTarget.select();
                // 選択しているテキストをクリップボードにコピーする
                document.execCommand("Copy");
                // コピーをお知らせする
                alert("コピーできました！ : " + copyTarget.value);
            }
        </script>
    @endif
</body>
