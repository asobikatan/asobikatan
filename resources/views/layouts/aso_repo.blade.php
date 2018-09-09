@extends($ua)

@section('title')
    【遊んでみた】{{$asobikata->name}}【あそレポ】| 日常をちょっと楽しく。
@endsection

@section('contents')
<!--  SNS共有ここから　-->
    @if($mode == 'org' || $mode == 'restored')
        <link rel="stylesheet" href="/css/modai.css">
        <div class="modal" style="padding: 0;">
          <input id="modal-trigger" class="checkbox" type="checkbox" checked="checked">
          <div class="modal-overlay">
           <label for="modal-trigger" class="o-close"></label>
           <div align="center" class="modal-wrap" style="margin: 0 auto;">
              <label for="modal-trigger" class="close">&#10006;</label>
              @if($mode == 'org')
                  <a href="{!!$tSharingUrl!!}"><img src="/img/Tweet.png" width=100% alt="Twitterでシェアする"></a>
                  <div style="float: right; padding: 2px; width: 20%;" class="fb-share-button" data-href="{!!$url!!}" data-layout="button_count" data-mobile-iframe="true"></div><span style="float: right; padding: 4px;">または：</span>
              @elseif($mode == 'restored')
                  <p>復元に成功しました</p>
              @endif
            </div>
         </div>
        </div>
        <label for="modal-trigger"></label>
    @endif
    <!--  SNS共有ここまで　-->

    @if($ua == 'objects.common')
        <a href="/">TOP</a> ＞　<a href="/user/{{$login_id}}/">{{$user_name}}さんのあそび</a>　＞　<a href="/article/{{$asobikata->id}}/">{{$asobikata->name}}</a>　＞　{{$user_name}}さんのあそレポ
        @if(isset($session_user->id) && $session_user->id == $user_id)
            <ul style="float: right;">
                <li style="float: left; margin:10px;"><a href="/aso-repo/{{$aso_repo_id}}/edit"><img src="/img/edit.png" alt="編集する"></a></li>
                <li style="float: left;"><form style="float: right;" method="post" action="/aso-repo/{{$aso_repo_id}}">
                    {!! csrf_field() !!}
                    <input name="_method" type="hidden" value="DELETE">
                    <input type="image" src="/img/delete.png" alt="削除する" class="post_btn">
                </form></li>
            </ul>
        @endif
    @else
        <a class="link" href="/article/{{$asobikata->id}}">{{$asobikata->name}}へ</a>
    @endif
    <h2>【あそレポ】〜{{$user_name}}さん編〜</h2>

    <iframe
        id="content"
        onLoad="adjust_frame_css(this.id)"
        src="/aso-repo/content/{{$aso_repo_id}}"
        name="aso_repo_content"
        style="border: 0; height: 100px; margin: 0;"
        class="item"
        scrolling="no"
        frameborder="0"></iframe>

    <h2 style="border-top: 1px solid gray;">{{$user_name}}さん</h2>
    <div class="item">
        <img onerror="this.src='/img/noimg.jpg';" src="/img/user/{{$user_id}}_50x50.jpg"><a href="/user/{{$login_id}}/">{{$user_name}}さんのあそびカタ一覧</a><br>
        <img onerror="this.src='/img/noimg.jpg';" src="/img/social_icon01.png"><a href="http://twitter.com/{{$login_id}}" target="_blank" rel="nofollow">{{$user_name}}さんのTwitter</a>
    </div>

    <h2>楽しさを共有しよう！</h2>
    @if($ua == 'objects.common')
        <ul class="clearfix share-buttons" style="margin-bottom: 60px;">
    @else
        <ul class="clearfix sp-share-buttons" style="margin-bottom: 60px; padding: 2%;">
    @endif
        <li><div class="fb-share-button" data-href="{{$url}}" data-layout="button_count" data-mobile-iframe="true"></div></li>
        <li class="others"><a href="http://twitter.com/share" class="twitter-share-button" data-url="{{$url}}"　data-text="この遊びおもしろい！" data-hashtags="あそびカタン" data-count="horizontal" data-lang="ja">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></li>
        <li class="others"><a href="http://b.hatena.ne.jp/entry/{{$url}}" class="hatena-bookmark-button" data-hatena-bookmark-title="{{$asobikata->name}}| あそびカタン" data-hatena-bookmark-layout="standard" title="このエントリーをはてなブックマークに追加"><img src="http://b.st-hatena.com/images/entry-button/button-only.gif" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script></li>
    </ul>

    @if($ua == 'objects.common')
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-format="autorelaxed"
             data-ad-client="ca-pub-9033830473144272"
             data-ad-slot="4705274183"></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    @endif
    <p>「{{$asobikata->name}}」で遊んだことがありますか？</p>
    <a href="/aso-repo/create?aid={{$asobikata->id}}"><img src="/img/detail/post_btn.png" alt="あそレポを投稿する" style="width: 100%;"></a>

    <script type="text/javascript">
        function adjust_frame_css(F){
            if(document.getElementById(F)) {
                var myF = document.getElementById(F);
                var myC = myF.contentWindow.document.documentElement;
                var myH = 100;
                if(document.all) {
                    myH  = myC.scrollHeight;
                } else {
                    myH = myC.offsetHeight;
                }
                myF.style.height = myH+"px";
            }
        }
    </script>
@endsection

@section('side')
    @include('objects.ad')
    @include('objects.sns')
@endsection

@section('footer')
    @include('sp_objects.footer')
    <script type="text/javascript"> adcropsjs_params={"site_id":25403,"type":"rectangle","interval":60,"rand":1}; </script>
    <script type="text/javascript" src="https://js.adcrops.net/adcropsjs.js"></script>
@endsection
