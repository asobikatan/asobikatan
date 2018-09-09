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

        #loading{
            display: none;
        }

        .loader,
        .loader:before,
        .loader:after {
            border-radius: 50%;
            width: 2.5em;
            height: 2.5em;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
            -webkit-animation: load7 1.8s infinite ease-in-out;
            animation: load7 1.8s infinite ease-in-out;
        }
        .loader {
            color: #000;
            font-size: 10px;
            margin: 0 auto;
            position: relative;
            text-indent: -9999em;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s;
        }
        .loader:before,
        .loader:after {
            content: '';
            position: absolute;
            top: 0;
        }
        .loader:before {
            left: -3.5em;
            -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s;
        }
        .loader:after {
            left: 3.5em;
        }
        @@-webkit-keyframes load7 {
          0%,
          80%,
          100% {
            box-shadow: 0 2.5em 0 -1.3em;
          }
          40% {
            box-shadow: 0 2.5em 0 0;
          }
        }
        @@keyframes load7 {
          0%,
          80%,
          100% {
            box-shadow: 0 2.5em 0 -1.3em;
          }
          40% {
            box-shadow: 0 2.5em 0 0;
          }
        }

    </style>
    <!-- 参考：https://projects.lukehaas.me/css-loaders/ -->
</head>

<body>
    <div id="loading" class="loader">投稿しています……</div>
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
        @if($ua == 'sp_objects.common')
            <input type="file" name="pics" accept="image/png, image/jpeg, image/gif">
            <br>
        @else
            <input type="file" style="width: 200px;" name="pics" accept="image/png, image/jpeg, image/gif">
        @endif
        <input class="misc-btn" type="submit" alt="送信する" value="->画像を投稿->" onClick='disp_loading();'>
        @if(isset($path))
            <input id="copyTarget" type="text" value='<img src="{{$path}}" style="width: 30%; float: right;">'>
            <button class="misc-btn" id="copyButton">タグをコピー</button>
        @else
            <input id="copyTarget" type="text" placeholder="ここにタグが出ます">
        @endif
        ※10MByteまで
    </form>
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

    <script>
        function disp_loading()
        {
            document.getElementById("loading").style.display="block";
        }
    </script>
    <!-- 参考：https://www.pazru.net/js/DOM/7.html -->

</body>
