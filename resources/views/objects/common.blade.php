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
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="/img/detail/find_icon.png">
    <style>
        h2 {
            background: url(/img/list/find_icon.png) no-repeat 0 0;
            border-bottom: solid 1px #B3CA64;
            padding-left: 80px;
            font-size: 35px;
            font-weight: bold;
            line-height: 60px;
            height: 70px;
            margin-bottom: 20px;
        }

        form h2{
            background: url(/img/form/find_icon.png) no-repeat 0 0;
        }

        ul, ol, li {
            list-style: none;
        }

        dd, ul, ol, li {
            margin: 0;
            padding: 0;
        }

        table {
            border-collapse: collapse;
        }

        table th, table td {
            border: solid 1px #ccc;
        }

        th{
            width: 205px;
            background-color: #f2f2f2;
        }

        td{
            width: 495px;
        }

        dt {
            font-size: 30px;
            padding-top: 5px;
            line-height: 20px;
            height: 20px;
            margin-bottom: 5px;
            font-weight: bold;
            color: #B3CA64;
        }

        .form1 dt{
            background: url(/img/top/about_chara.png) no-repeat 0 0;
            background-size: contain;
            padding-left: 30px;
        }

        dl{
            padding-bottom: 30px;
        }

        .clearfix:after{
        	content: "";
        	clear: both;
        	display: block;
        }

        .error{
            color: red;
        }

        .form2{
            float: left;
        }

        .form1 input, textarea{
            width: 485px;
            margin: 5px;
            border: solid 1px #ccc;
        }

        .form2 td{
            padding: 8px;
        }

        a:link, a:visited {
            text-decoration: underline;
            color: #000;
        }

        .aso_repo:hover, a img:hover, .modal .btn:hover, label img:hover, .post_btn:hover{
            position: relative;
            top: 2px;
            left: 2px;
            cursor: pointer;
        }

        .aso_repo img:hover{
            top: 0px;
            left: 0px;
        }

        .submit{
            position: relative;
            top: 18px;
            left: 152px;
        }

        .submit:hover{
            position: absolute;
            top: 20px;
            left: 154px;
        }

        body{
            background-color: rgb(179, 201, 106);
        }

        header{
            width: 900px;
            height: 140px;
            margin:0 auto;
            background-image: url("/img/head_back.jpg");
            background-size: contain;
            padding: 60px 50px 0px 50px;
        }

        header ul{
            float: right;
            margin-top: 50px;
        }

        header li{
            float: right;
            margin-left: 10px;
        }

        header form{
            float: right;
            position: relative;
            height: 95px;
            width: 220px;
        }

        header .box{
            position: absolute;
            left: 0;
            bottom: 5px;
            border: 3px inset gray;
        }

        header .submit{
            position: absolute;
            right: 0;
            bottom: 0;
        }

        footer{
            position: relative;
            width: 1000px;
            margin: 0 auto;
            padding-top: 30px;
            font-size: 9pt;
        }

        .top{
            position: absolute;
            top: -20px;
            right: 10px;
        }

        .top:hover{
            position:absolute;
            top: -18px;
            right: 8px;
        }

        footer .left{
            width: 450px;
            float: left;
        }

        footer .right{
            width: 450px;
            float: right;
        }

        footer li{
            list-style: none;
            float: left;
        }

        footer b{
            font-size: 10pt;
        }

        .main{
            width: 960px;
            margin:0 auto;
            padding: 20px;
            background-image: url("/img/main_back.jpg");
            background-size: 97% auto;
            font-size: 11pt;
            line-height: 200%;
        }

        .contents{
            width: 700px;
            display: inline-block;
        }

        .about_box{
            color: #fff;
            height:180px;
            background: url("/img/top/about_back.png") no-repeat;
            background-size: contain;
            padding:10px;
            position: relative;
            margin-bottom: 50px;
        }

        .about_box p{
            width: 531px;
            padding:10px;
            float: left;
        }

        .about_box img{
            float: right;
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        .about_box a:link, .about_box a:visited{
            text-decoration: underline;
            color: #fff;
        }

        .play_list{
            width: 700px;
            position: relative;
            margin-bottom: 50px;
        }

        .play_list ul{
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .play_list li{
            float: left;
            margin: 5px 13px;
        }


        .play_list ul img{
             width: 202px;
             height: 115px;
        }

        .border_box {
            width: 100%;
            background: url(/img/border_box.png) no-repeat 0 0;
            background-size: cover;
            position: relative;
        }

        .border_box .border_body {
            background: url(/img/border_box_end.png) no-repeat 0 bottom;
            background-size: contain;
            padding: 10px 30px 35px;
        }

        .popular_item li h3 {
            border-bottom: dotted 1px #B3CA64;
            background: url(../../img/icon/find_icon.png) no-repeat 0 0;
            padding-left: 40px;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .popular_item ul{
            width: 100%;
        }

        .floatRight {
            width: 106px;
            height: 100px;
            float: right;
        }

        .floatLeft{
            float: left;
        }

        .popular_item .floatLeft {
            width: 510px;
        }

        .list_item ul, .list_item, .search_head {
            display: block;
            width: 700px;
        }

        .search_head {
            height: 30px;
            padding: 10px;
            border: solid 1px #ccc;
            margin-bottom: 20px;
            background: #fff;
        }

        .search_head .floatLeft {
            background: url(../../img/list/search_icon.png) no-repeat 0 center;
            font-weight: bold;
            font-size: 25px;
            line-height: 35px;
            height: 35px;
            padding-left: 40px;
        }

        .photo {
            float: left;
            height: 200px;
            padding-right: 20px;
        }

        .list_item{
            position: relative;
            margin-bottom: 80px;
        }

        .list_item .floatLeft {
            width: 350px;
        }

        .item .floatLeft{
            width: 470px;
        }

        .list_item h3{
            margin-top: 0;
        }

        .nice_btn a {
            background: url(/img/nice_btn.png) no-repeat center 10px;
            width: 63px;
            height: 63px;
            padding-top: 8px;
            padding-right: 15px;
            display: block;
            font-weight: bold;
            text-decoration: none;
            text-align: right;
        }

        .side_back_g .nice_btn a{
            width: 184px;
            height: 80px;
            background-size: contain;
            text-align: center;
            font-size: 12pt;
        }

        .user{
            display: block;
            float: right;
            margin-top: 5pt;
        }

        .category {
            line-height: 170%;
            width: 630px;
            padding: 2px 6px;
            background: #F4F3EA;
            display: inline-block;
            font-size: 8pt;
            margin-bottom: 20px;
        }

        .category a {
            background: url(/img/icon/star_icon.png) no-repeat 0 center;
            padding-left: 15px;
            padding-right: 10px;
        }

        .list_item .category {
            width: 476px;
            float: right;
            position: absolute;
            bottom: 0;
            right: 0;
            margin-bottom: 0;
        }

        .list_item .user{
            position: absolute;
            bottom: 25px;
            right: 0px;
        }

        .user img {
            width: 20px;
            height: 20px;
            padding-right: 10px;
        }

        .side{
            display: inline-block;
            float: right;
            width: 200px;
        }

        .side_back_g {
            background: url("/img/side/side_back_g.png") repeat-y 0;
            padding: 8px;
            font-size: 9pt;
            float: left;
            width: 184px;
            margin-bottom: 20px;
        }

        .side_back_g li {
            background: url("/img/side/about_btn.png") no-repeat 0 0;;
            display: block;
            padding-left: 10px;
            padding-bottom: 15px;
            height: 51px;
            line-height: 51px;
        }

        .item .category{
            width: 100%;
            margin: 20px 0;
        }

        .photoframe img{
            width: 200px;
            height: 200px;
            object-fit: contain;
        }

        .conditions{
            float:right;
        }

        .share-buttons{
            float: left;
            margin-top: 5px;
        }

        .share-buttons li{
            float: left;
            margin: 0 5px;
        }

        .others{
            padding-top: 9px;
        }

        .item{
            width: 100%;
        }

        .flow li, .point{
            border: solid 1px #f2f2f2;
            background: #fff;
            display: box;
            padding: 5px;
            margin-bottom: 10px;
            box-shadow: 0 0 8px gray;
        }

        .flow img{
            width: 200px;
            float: right;
        }

        .point {
            background: #E3ECC6;
            padding: 15px;
        }

        .point h3 {
            color: #495E0D;
            font-weight: bold;
            background: url("/img/detail/point_icon.png") no-repeat 0 center;
            padding-left: 30px;
            height: 30px;
            line-height: 30px;
            margin-bottom: 8px;
        }

        .img_create{
            margin-bottom: 30px;
            padding: 5px;
        }

        .img_create button{
            margin: 5px;
        }

        .img_create input{
            width: 400px;
        }

        .big-text{
            width: 100%;
        }

        .aso_repo{
            width: 178px;
            height: 380px;
            display: block;
            border: solid 1px #f2f2f2;
            background: #fff;
            box-shadow: 0 0 8px grey;
            float: left;
            margin: 0 50px 30px 0;
            padding: 10px;
        }

        .aso_repo img{
            width: 180px;
            height: 180px;
            object-fit: contain;
        }

        .grad-item {
          position: relative;
          overflow: hidden;
          height: 360px; /*隠した状態の高さ*/
          padding-top: 10px;
        }
        .grad-item a{
            text-align: center;
        }
        .grad-item img{
            width: 100px;
            height: 100px;
            object-fit: contain;
        }
        .grad-item input[type="radio"], .grad-item input[type="checkbox"]{
            display:none;
        }

        /*　ボタン 未選択時の背景指定　*/
        input[type="radio"] + label{
            margin:10px 2px 10px 30px;
            padding: 2px;
            background-size:27px 27px;
            cursor:pointer;
            float: left;
        }
        input[type="checkbox"] + label {
            margin:4px;
            padding: 2px;
            background-size:27px 27px;
            cursor:pointer;
            float: left;
        }

        /*　ラジオボタン 選択時の背景指定　*/
        input[type="radio"]:checked + label {
            margin:8px 0 8px 28px;
            border: 2px solid green;
        }
         /*　チェックボックス 選択時の背景指定　*/
        input[type="checkbox"]:checked + label {
            margin:2px;
            border: 2px solid red;
            opacity: 0.6;
        }

        label{
            width: 100px;
            height: 100px;
        }

        .copyright{
            border-top: 1px dotted black;
            margin-top: 20px;
            padding: 20px;
            width: 1000px;
            text-align: center;
        }

        .post_btn{
            margin-top: 10px;
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
            margin:10px;
            padding:20px;

            top:40%;
            left:25%;
            width:500px;
            height:10%;

            position:fixed;
            opacity:0;
            z-index:1000;
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
        <a href="/"><img src="/img/logo.png"></a>
        <ul>
            <li><a target=”_blank” href="https://www.facebook.com/asobikatan"><img src="/img/social_icon02.png"></a></li>
            <li><a target=”_blank” href="https://twitter.com/asobikatan"><img src="/img/social_icon01.png"></a></li>
        </ul>
        <form action="https://www.google.com/search" method="get">
            <input class="box" type="text" name="q" placeholder="あそびカタン内を検索">
            <input type="hidden" name="hl" value="ja">
            <input type="hidden" name="hq" value="inurl:asobikatan.jp">
            <div class="submit"><input type="image" src="/img/search_btn.png" alt="検索"></div>
        </form>
    </header>
    <div class="main clearfix">
        <div class="contents">@yield('contents')</div>
        <div class="side">@yield('side')</div>
    </div>

    <footer>
        <a class="top" href="#top"><img src="/img/pagetop.png"></a>
        <div class="clearfix">
            <div class="left">
                <img src="/img/logo_foot.jpg">
                <p>あそびカタン。は全国のユーザーが独創的かつ奇抜な発想で思いついた"あそび"をシェアするためのソーシャルサイトです。1人での暇つぶし、友達数人での過ごし方、バーベキュー・キャンプでのリクリエーション、結婚式二次会・パーティーでの余興などに使えるオリジナルな遊び方を検索できることを目指しています。</p>
            </div>
            <div class="right">
                <b>■あそびカタを探す</b></br>
                    <a href="/category/c1">1人のあそび</a>｜
                    <a href="/category/c2">大勢のあそび</a>｜
                    <a href="/category/c3">0円でできる</a>｜
                    <a href="/category/c4">室内のあそび</a>｜
                    <a href="/category/c6">アウトドア</a>｜</br>
                    <a href="/category/c9">車内のあそび</a>｜
                    <a href="/category/c5">すぐ終わる</a>｜
                    <a href="/category/c7">こどもと遊ぼう</a>｜
                    <a href="/category/c8">異性と盛り上がる</a>

                </br></br><b>■メニュー</b></br>
                    @if(Request::path() != "/")
                        <a href="/">あそびカタン。トップ</a>｜
                    @endif
                    <a href="/article/create">あそびカタ募集</a>｜
                    <a href="/about">アバウト</a>｜</br>
                    <a href="/kiyaku">利用規約</a>｜
                    <a href="/kojin">個人情報保護方針</a>｜
                    <a href="mailto:info@asobikatan.jp">お問合せ</a></br></br>
                    @if(strpos(url()->full(), '?') === false)
                        <a href="{{url()->full()}}?uao=sp">スマートフォン版</a>｜PC版
                    @else
                        <a href="{{url()->full()}}&uao=sp">スマートフォン版</a>｜PC版
                    @endif
            </div>
        </div>
        <div class="copyright">
            Copyright © 2012 Asobikatan.
        </div>
    </footer>
