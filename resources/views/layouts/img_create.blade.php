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

        #loader-bg {
          display: none;
          position: fixed;
          width: 100%;
          height: 100%;
          top: 0px;
          left: 0px;
          z-index: 1;
        }
        #loader {
          display: none;
          position: fixed;
          background-color: #fff;
          width: 50%;
          height: 50%;
          top: 25%;
          left: 25%;
          text-align: center;
          z-index: 2;
          color: #000;
        }
    </style>
</head>

<body>
    <div id="loader-bg">
        <div id="loader">
            読み込み中です……
        </div>
    </div>
    <div id="wrap">
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
            <input class="misc-btn" type="submit" alt="送信する" value="->画像を投稿->">
            @isset($path)
                <input id="copyTarget" type="text" value='<img src="{{$path}}" style="width: 30%; float: right;">'>
                <button class="misc-btn" id="copyButton">タグをコピー</button>
            @else
                <input id="copyTarget" type="text" placeholder="ここにタグが出ます">
            @endisset
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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>
        $(function() {
          var h = $(window).height();

          $('#wrap').css('display','none');
          $('#loader-bg ,#loader').height(h).css('display','block');
        });

        $(window).load(function () { //全ての読み込みが完了したら実行
          $('#loader-bg').delay(800).fadeOut(800);
          $('#loader').delay(600).fadeOut(300);
          $('#wrap').css('display', 'block');
        });

        //10秒たったら強制的にロード画面を非表示
        $(function(){
          setTimeout('stopload()',10000);
        });

        function stopload(){
          $('#wrap').css('display','block');
          $('#loader-bg').delay(900).fadeOut(800);
          $('#loader').delay(600).fadeOut(300);
        }
        </script>
    </div>
</body>
