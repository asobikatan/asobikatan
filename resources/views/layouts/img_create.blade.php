<!DOCTYPE html>
<html>
<head>
    <!-- 牛島一樹(2674je@gmail.com)が作りました -->
    <meta charset="utf-8">
    <style>
        body{
            width: 100%;
            margin: 0;
        }
        @if($ua == 'sp_objects.common')
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
        <input type="hidden" name="aid" value="{{$aid}}">
        <input type="file" name="pics" accept="image/png, image/jpeg, image/gif">
        @if($ua == 'sp_objects.common')
            <br>
        @endif
        <input type="submit" alt="送信する" value="->画像を投稿->">
        @isset($path)
            <input id="copyTarget" type="text" value='<img src="{{$path}}" style="width: 30%; float: right;">' readonly>
            <button onclick="copyToClipboard()">タグをコピー</button>
        @else
            <input id="copyTarget" type="text" placeholder="ここにタグが出ます" readonly>
        @endisset
        ※10MByteまで
    </form>
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
</body>
