@extends('objects.common')

@section('title')
    {{$asobikata->name}}| 日常をちょっと楽しく。
@endsection

@section('contents')
<!--  SNS共有ここから　-->
    @if($mode == 'org' || $mode == 'restored')
        <link rel="stylesheet" href="/css/modai.css">
        <div class="modal">
          <input id="modal-trigger" class="checkbox" type="checkbox" checked="checked">
          <div class="modal-overlay">
           <label for="modal-trigger" class="o-close"></label>
           <div align="center" class="modal-wrap" style="margin: 0 auto;">
              <label for="modal-trigger" class="close">&#10006;</label>
              @if($mode == 'org')
                  <a href="{!!$tSharingUrl!!}"><img src="/img/tweet.png" width=100% alt="Twitterでシェアする"></a>
                  <div style="float: right; padding: 2px;" class="fb-share-button" data-href="{!!$url!!}" data-layout="button_count" data-mobile-iframe="true"></div><div style="float: right;">または：</div>
              @elseif($mode == 'restored')
                  <p>復元に成功しました</p>
              @endif
            </div>
         </div>
        </div>
        <label for="modal-trigger"></label>
    @endif
    <!--  SNS共有ここまで　-->

    <a href="/">TOP</a> ＞　<a href="/user/{{$login_id}}/">{{$user_name}}さんのあそび</a>　＞　{{$asobikata->name}}
    @if(isset($session_user->id) && $session_user->id == $user_id)
        <ul style="float: right;">
            <li style="float: left; margin:10px;"><a href="/article/{{$asobikata->id}}/edit"><img src="/img/edit.png" alt="編集する"></a></li>
            <li style="float: left;"><form style="float: right;" method="post" action="/article/{{$asobikata->id}}">
                {!! csrf_field() !!}
                <input name="_method" type="hidden" value="DELETE">
                <input type="image" src="/img/delete.png" alt="削除する" class="post_btn">
            </form></li>
        </ul>
    @endif
    <h2>{{$asobikata->name}}</h2>

    <div class="item">
        <ul>
            <li class="photo">
                <div class="photoframe">
                    @if($asobikata->main_pic == 0 || $asobikata->main_pic == null)
                        <img src="/img/asobi/{{$asobikata->id}}/main_200x200.jpg">
                    @else
                        <img src="/img/asobi_def/def_{{$asobikata->main_pic}}.png">
                    @endif
                </div>
            </li>
            <li class="floatLeft">
                <p>{{$asobikata->outline}}</p>
                <div class="conditions">
                    @if($asobikata->place != null)
                        遊ぶ場所　：{{$asobikata->place}}</br>
                    @endif
                    @if($asobikata->tools != null)
                        必要なもの：{{$asobikata->tools}}</br>
                    @endif
                        遊べる人数：
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
                    遊べる年齢：
                    @if($asobikata->age_min >= 20)
                        オトナ向け
                    @elseif($asobikata->age_max <= 10)
                        子ども向け
                    @else
                        年齢問わず
                    @endif
                    @if(isset($asobikata->price) && $asobikata->price > 0)
                        </br>
                        かかるお金：{{number_format($asobikata->price)}}円くらい
                    @endif
                    </br>
                    盛り上がる相手：
                    @if($asobikata->detail_3_5 == 1)
                        特に異性と
                    @elseif($asobikata->detail_3_5 == 2)
                        特に同性と
                    @else
                        性別問わず
                    @endif
                </div>
            </li>
        </ul>
        <p class="user"><img onerror="this.src='/img/noimg.jpg';" src="/img/user/{{$user_id}}_20x20.jpg"><a href="/user/{{$login_id}}/">{{$user_name}}</a></p>

        <ul class="share-buttons">
            <li class="others"><a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="basic-counter" data-hatena-bookmark-height="20" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script></li>
            <li><div class="fb-share-button" data-href="{{$url}}" data-layout="button_count" data-mobile-iframe="true"></div></li>
            <li class="others"><a href="http://twitter.com/share" class="twitter-share-button" data-url="{{$url}}"　data-text="この遊びおもしろい！" data-hashtags="あそびカタン" data-count="horizontal" data-lang="ja">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></li>
            <li class="others">
                <iframe src="/hidoiine?id={{$asobikata->id}}&mode=hdisp" name="hidoiine" width="120" height="29" frameborder="0" style="margin: 0;"></iframe>
            </li>
        </ul>

        <div class="category">
            @include('objects.categories')
        </div>
    </div>

    <ul class="flow">
        @for($i = 1; $i <= 12; $i++)
            @php
                if($asobikata->{"contents_$i"} == null && $detail_imgs[$i] == null){
                    break;
                }
                $content = $asobikata->{"contents_$i"};
            @endphp
            <li>
                <dl>
                    <dt>{{$i}}</dt>
                    <dd class="clearfix">
                        @if($detail_imgs[$i] != null)
                            <img src={!!$detail_imgs[$i]!!}>
                        @endif
                        <p>{!!nl2br($content)!!}</p>
                    </dd>
                </dl>
            </li>
        @endfor
    </ul>

    <div class="point">
        <h3>盛り上がりポイント！！</h3>
        <p>{!!nl2br($asobikata->moripoint)!!}</p>
    </div>

    @include('objects.aso_repo_index')

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-format="autorelaxed"
         data-ad-client="ca-pub-9033830473144272"
         data-ad-slot="4705274183"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <a href="/article/create"><img src="/img/detail/recruitment_btn.png" alt="あそびかたを投稿する" width="700"></a>
@endsection

@section('side')
    @include('objects.ad')
    @include('objects.user')
    @include('objects.yattemitais')
    @include('objects.sns')
@endsection
