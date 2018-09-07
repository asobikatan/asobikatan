<div class="misc">
    <p style="font-size: 80%;">あなたもあそびカタを投稿してみませんか？</p>
    <a class="misc-btn" href="/article/create">あそびカタを投稿する</a>
</div>
<div class="misc clearfix">
    <span style="font-size:50%; text-align:center;">フォローすると最新の投稿や人気の遊びがちょろちょろ届くよ。<br>やったあ!<br>
    <a href="https://twitter.com/asobikatan?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-size="large" data-lang="ja" data-show-count="false">Follow @asobikatan</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <div id="face_book" style="padding:0; margin: 0 auto; width: 234px;">
        <div class="fb-page" style="padding:0;" data-href="https://www.facebook.com/asobikatan/" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/asobikatan/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/asobikatan/">あそびカタン。</a></blockquote></div>
    </div>
</div>

<div class="misc">
    @if(strpos(url()->full(), '?') === false)
        スマートフォン版｜<a href="{{Request::url()}}?uao=ja">PC版</a>
    @else
        スマートフォン版｜<a href="{{Request::url()}}&uao=ja">PC版</a>
    @endif
</div>
<div class="misc">
    @if(Request::path() != "/")
        <a href="/">あそびカタン。トップ</a>｜</br>
    @endif
        <a href="/article/create">あそびカタ募集</a>｜
        <a href="/about">アバウト</a>｜</br>
        <a href="/kiyaku">利用規約</a>｜
        <a href="/kojin">個人情報保護方針</a>｜
        <a href="mailto:info@asobikatan.jp">お問合せ</a>
</div>
