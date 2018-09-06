<!DOCTYPE html>
<html>
<head>
    <!-- 牛島一樹(2674je@gmail.com)が作りました -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-60126125-6"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-60126125-6');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="/img/detail/find_icon.png">
    <style>
        body{
            width: 100%;
            margin: 0;
            background-color: rgb(242,242,242);
        }

        div{
            padding: 2%;
            width: 96%;
        }

        ul, ol, li {
            list-style: none;
        }

        dd, ul, ol, li {
            margin: 0;
            padding: 0;
        }

        dl{
            padding-bottom: 30px;
        }

        textarea, input{
            width: 86%;
            margin: 5%;
            padding: 2%;
            border: 1px solid gray;
            border-radius: 10px;
            box-shadow:0px 0px 1px 1px #ccc inset;
        }

        h3, h2{
            color: #FFFFFF;
            font-weight: bold;
            text-shadow: 0 -1px 0 #447900;
            background-color: rgb(179, 201, 106);
            margin: 0;
            padding: 0 2%;
            width: 96%;
            border-bottom: 1px solid gray;
            font-size: 1.17em;
        }

        h3, h2, h4, .list_item p{
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        label{
            font-size: 80%;
        }

        .clearfix:after{
        	content: "";
        	clear: both;
        	display: block;
        }

        .link, .list_item{
            display: block;
            text-decoration: none;
            color: black;
            border-bottom: 1px solid gray;
            padding: 1% 5%;
            width: 90%;
            background: linear-gradient(#fff, #f0f0f0);
        }

        .list_item img{
            float: left;
            height: 20%;
            width: 20%;
            object-fit: contain;
        }

        h4, .list_item p{
            margin: 0 0 0 25%;
        }

        .list_item p{
            font-size: 60%;
        }

        .item{
            padding: 5% 5% 10% 5%;
            width: 90%;
            border-bottom: 1px solid gray;
        }

        .floatLeft{
            float: left;
            padding: 0;
            width: 40%;
        }

        .floatLeft img{
            height: 100%;
            width: 100%;
            object-fit: contain;
        }

        .floatRight{
            float: right;
            padding: 0 0 0 5%;
            width: 55%;
        }

        .category a {
            background: url(/img/icon/star_icon.png) no-repeat 0 center;
            padding-left: 15px;
            padding-right: 10px;
        }

        .flow img{
            width: 40%;
            float: right;
        }

        .logo{
            background-color: rgb(179, 201, 106);
            border-bottom: 1px solid gray;
        }

        .search_btn{
            width: 20%;
            display: inline-block;
            float: right;
            padding: 0;
        }

        .misc{
            margin: 3% 0;
        }

        .misc-btn, select{
            display: inline-block;
            background: linear-gradient(#fff, #f0f0f0);
            line-height: 200%;
            width: 80%;
            margin: 0 10%;
            border-radius: 10px;
            box-shadow:0px 0px 3px 3px #cfcfcf;
            text-decoration: none;
            color: black;
            text-align: center;
            vertical-align: middle;
        }

        select{
            width: 40%;
            margin: 0 2.5%;
            padding: 2%;
        }

        .img_create .misc-btn{
            width: 70%;
        }

        .img_create input{
             width: 65%;
             margin: 2% 10%;"
        }

        .post_btn{
            border: none;
            box-shadow: none;
            padding: 0;
            width: 90%;
        }

        .error{
            color: red;
        }

        .sp-share-buttons{
            margin-top: 5px;
        }

        .sp-share-buttons li{
            float: left;
            margin: 0 5px;
        }

        .others{
            padding-top: 4px;
        }

        .lap{
            visibility: collapse;
        }
        .lap:target{
            visibility: visible;
        }
        .lap:target .overlap{
            opacity: 0.2;
        }
        .lap:target .innerWindow{
            opacity: 1;
        }
        .overlap{
            top:0;
            left:0;
            width:100%;
            height:100%;

            position:fixed;

            opacity:0;
            background:#000;

            z-index: 900;
        }
        .innerWindow{
            background:#fff;

            padding: 1%;

            right: 10%;
            top:45%;

            width:80%;

            position:fixed;
            opacity:0;
            z-index:1000;
        }

        .border_box {
            width: 96%;
            background: white;
            border: 1px solid black;
            position: relative;
        }

        /*　ボタン 未選択時の背景指定　*/
        input[type="radio"] + label{
            width: 29%;
            margin: 0 2.5% 2.5% 0;
            padding: 2px;
            float: left;
        }

        /*　ボタン 選択時の背景指定　*/
        input[type="radio"]:checked + label{
            border: 2px solid green;
            padding: 0;
        }

        input[type="radio"]{
            display:none;
        }

        input[type="checkbox"]{
            border: 0px none white;
            line-height: 200%;
            width: 20px;
            margin: 0;
            border: none;
        }

        .grad-item {
          position: relative;
          overflow: hidden;
          height: 360px; /*隠した状態の高さ*/
          padding-top: 10px;
        }

        .grad-item::before {
          display: block;
          position: absolute;
          bottom: 0;
          left: 0;
          width: 100%;
          height: 40px; /*グラデーションで隠す高さ*/
          background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 50%, rgba(255,255,255,0.9) 50%, #fff 100%);
          background: linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 50%, rgba(255,255,255,0.9) 50%, #fff 100%);
          content: "";
        }
        .grad-trigger {
          display: none; /*チェックボックスは常に非表示*/
        }
        .grad-trigger:checked ~ .grad-btn {
            display: none;
        }
        .grad-trigger:checked ~ .grad-item {
          height: auto; /*チェックされていたら、高さを戻す*/
        }
        .grad-trigger:checked ~ .grad-item::before {
          display: none; /*チェックされていたら、grad-itemのbeforeを非表示にする*/
        }

    </style>
</head>
<body>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v3.1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <header>
        <!-- ここにheader -->
        <div class="logo clearfix" ><a href="/"><img style="width: 78%;" src="/img/logo.png"></a>
            <div class="search_btn" id="openlocation"><a href="#lap"><img style="width: 100%" src="/img/search_btn.png"></a>
                <div class="lap" id="lap">
                    <a href="#openlocation" class="overlap">X</a>
                    <div class="innerWindow clearfix">
                        <form action="http://www.google.com/search" method="get">
                            <input style="width: 60%; margin-top: 13%; line-height: 100%; border: 1px gray solid; " class="box" type="text" name="q" placeholder="あそびカタン内を検索">
                            <input type="hidden" name="hl" value="ja">
                            <input type="hidden" name="hq" value="inurl:asobikatan.jp">
                            <div style="width: 20%; float: right;" class="submit"><input style="width: 100%; border: none; box-shadow: none;" type="image" src="/img/search_btn.png" alt="検索"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ifでTOPでなければTOPへ -->
        @if(Request::path() != '/')
            <a class="link" href="/">TOPへ</a>
        @endif
    </header>

    @yield('contents')

    <footer style="text-align: center; padding-top: 10%;">
        @yield('footer')
        <h3>Copyright © 2012 Asobikatan.</h3>
    </footer>
</body>
