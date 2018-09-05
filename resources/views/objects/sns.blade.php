@if(isSet($session_user))
    <h3><img src="/img/side/find_login.png"></h3>
    <div class="side_back_g">
        <div style="text-align: right;">[<a href="/outer/logout/">ログアウト</a>]</div>
        <a href="/user/{{$session_user->login_id}}/"><img src="/img/user/{{$session_user->id}}_50x50.jpg"></a>
        <a href="/user/{{$session_user->login_id}}/">{{$session_user->name}}</a>さん<br>
        <form action="/article/restore" method="get">
            <input type="text" name="restore_id" placeholder="復元コード" style="float: left; width: 110px; margin-top: 5px;">
            <input type="submit" value="記事を復元">
        </form>
    </div>
@else
    <a href="/outer/login"><img src="/img/side/social_btn01.jpg"></a>
@endif

<span style="font-size:10px;">フォローすると最新の投稿や人気の遊びがちょろちょろ届くよ。やったあ!<br>
↓<br></span>
<a href="https://twitter.com/asobikatan" class="twitter-follow-button" data-show-count="false" data-lang="ja">@asobikatanさんをフォロー</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></br></br>

<span style="font-size:10px; margin-top: 10px;">いいねすると最新の投稿や人気の遊びがちょろちょろ届くよ。嬉しいね!<br>
↓<br></span>
<div id="face_book">
<div class="fb-page" data-href="https://www.facebook.com/asobikatan/" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/asobikatan/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/asobikatan/">あそびカタン。</a></blockquote></div>
</div>
