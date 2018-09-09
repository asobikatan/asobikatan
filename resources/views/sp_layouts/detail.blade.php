@extends('sp_objects.common')

@section('title')
    {{$asobikata->name}}| 日常をちょっと楽しく。
@endsection

@section('contents')
    <!--  SNS共有ここから　-->
    @if($mode == 'org' || $mode == 'restored')
        <link rel="stylesheet" href="/css/modai.css">
        <div class="modal" style="padding: 0;">
          <input id="modal-trigger" class="checkbox" type="checkbox" checked="checked">
          <div class="modal-overlay">
           <label for="modal-trigger" class="o-close"></label>
           <div align="center" class="modal-wrap">
              <label for="modal-trigger" class="close">&#10006;</label>
              @if($mode == 'org')
                  <a href="{!!$tSharingUrl!!}"><img onerror="this.src='/img/noimg.jpg';" src="/img/tweet.png" width=100% alt="Twitterでシェアする"></a>
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

    <a class="link" href="/user/{{$login_id}}">{{$user_name}}さんのあそびカタ一覧</a>
    <h3>{{$asobikata->name}}</h3>
    <div class="clearfix">
        <div class="clearfix floatLeft">
            @if($asobikata->main_pic == 0 || $asobikata->main_pic == null)
                <img onerror="this.src='/img/noimg.jpg';" src="/img/asobi/{{$asobikata->id}}/main_200x200.jpg">
            @else
                <img onerror="this.src='/img/noimg.jpg';" src="/img/asobi_def/def_{{$asobikata->main_pic}}.png">
            @endif
            <iframe src="/yattemitai?id={{$asobikata->id}}&mode=ydisp_list" name="yattemitai" width="106px" height="106px" frameborder="0" allowtransparency='true'　style="margin: 0;"></iframe>
            <ul class="share-buttons">
                <li class="others"><a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="basic-counter" data-hatena-bookmark-height="20" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script></li>
                <li style="margin-bottom: 8px;"><div class="fb-share-button" data-href="{{$url}}" data-layout="button_count" data-mobile-iframe="true"></div></li>
                <li class="others"><a href="http://twitter.com/share" class="twitter-share-button" data-url="{{$url}}"　data-text="この遊びおもしろい！" data-hashtags="あそびカタン" data-count="horizontal" data-lang="ja">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></li>
                <li class="others">
                    <iframe src="/hidoiine?id={{$asobikata->id}}&mode=hdisp" name="hidoiine" width="100%" height="29" frameborder="0" style="margin: 0;"></iframe>
                </li>
            </ul>
        </div>
        <div class="clearfix floatRight">
            <p style="margin-top: 0;">{{$asobikata->outline}}</p>
            @if($asobikata->place != null)
                <b>遊ぶ場所</b></br>
                {{$asobikata->place}}</br>
            @endif
            @if($asobikata->tools != null)
                <b>必要なもの</b></br>{{$asobikata->tools}}</br>
            @endif
                <b>遊べる人数</b></br>
            @if($asobikata->number_safe_min == -1)
                @if($asobikata->number_safe_max == 9999)
                    何人でも
                @else
                    {{$asobikata->number_safe_max}}人くらいまで
                @endif
            @elseif($asobikata->number_safe_max == 9999)
                {{$asobikata->number_safe_min}}人くらいから
            @elseif($asobikata->number_safe_min == $asobikata->number_safe_max)
                {{$asobikata->number_safe_min}}人くらい
            @else
                {{$asobikata->number_safe_min}}人〜{{$asobikata->number_safe_max}}人くらい
            @endif
            </br>
            <b>遊べる年齢</b></br>
            @if($asobikata->age_min >= 20)
                オトナ向け
            @elseif($asobikata->age_max <= 10)
                子ども向け
            @else
                年齢問わず
            @endif
            @if(isset($asobikata->price) && $asobikata->price > 0)
                </br>
                <b>かかるお金</b></br>{{number_format($asobikata->price)}}円くらい
            @endif
            </br>
            <b>盛り上がる相手</b></br>
            @if($asobikata->detail_3_5 == 1)
                特に異性と
            @elseif($asobikata->detail_3_5 == 2)
                特に同性と
            @else
                性別問わず
            @endif
            </br><b>投稿者</b></br><img onerror="this.src='/img/noimg.jpg';" src="/img/user/{{$user_id}}_20x20.jpg"><a href="/user/{{$login_id}}/">{{$user_name}}</a>
        </div>
    </div>
    <div class="item category">
        @include('objects.categories')
    </div>
    <h3>あそびカタ</h3>
    @for($i = 1; $i <= 12; $i++)
        @php
            if($asobikata->{"contents_$i"} == null && $detail_imgs[$i] == null){
                break;
            }
            $content = $asobikata->{"contents_$i"};
        @endphp
        <div class="clearfix item">
            {{$i}}
            @if($detail_imgs[$i] != null)
                <img onerror="this.src='/img/noimg.jpg';" src={!!$detail_imgs[$i]!!}>
            @endif
            {!!nl2br($content)!!}
        </div>
    @endfor

    <h3>盛り上がりポイント！！</h3>
    <div class="clearfix item">{!!nl2br($asobikata->moripoint)!!}</div>

    @include('objects.aso_repo_index')

    <h3>人気のあそびカタ。</h3>
    @include('sp_objects.list')

@endsection

@section('footer')
    @include('sp_objects.footer')
    <script type="text/javascript"> adcropsjs_params={"site_id":25403,"type":"rectangle","interval":60,"rand":1}; </script>
    <script type="text/javascript" src="https://js.adcrops.net/adcropsjs.js"></script>
@endsection
