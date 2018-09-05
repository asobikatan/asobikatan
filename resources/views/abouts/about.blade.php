@extends($ua)

@section('title')
    あばうと | あそびカタン。
@endsection


@section('contents')
    @if($ua == 'objects.common')
        <a href="/">TOP</a> ＞　あばうと
    @endif

    <h2 id="about01">あそびカタン。について</h2>
    <div class="item">
        あそびカタン。は、誰かが思いついたあそびをみんなでシェアするためのサイトです。</br>
        あなたが思いついた独自のあそびを投稿したり、誰かが投稿したあそびを見て楽しんだり、人数や状況に応じてあそびを検索したりできます。</br>
        まずはぜひ、<a href="/article">あそび一覧</a>を眺めてみてください。</br>
        そして、あなたなりのあそびを<a href="/article/create">投稿してみてください</a>！</br>
	</div>

    <h2 id="about02">例えばこんな使い方</h2>
    <div class="item">
        ・友達と居るんだけど時間が空いてしまったので、何か面白いことないかな……</br>
        ・暇つぶしの方法にもっとバリエーションが欲しい！</br>
        ・面白いあそびを思いついてしまった！みんなに知らせよう！</br>
    </div>

    <h2 id="about03">作ってる人</h2>
    <div class="item" style="border: none;">
		<img src="/img/pro.png" style="vertical-align:text-bottom"> <a href="http://twitter.com/kenhori2" target="_blank">堀元 見</a>が作っています。 <br>
    </div>

@endsection

@section('side')
    <div id="about" class="side_back_g">
        <ul>
    		<li><a href="#about01">あそびカタン。について</a></li>
    		<li><a href="#about02">例えばこんな使い方</a></li>
    		<li><a href="#about03">作ってる人</a></li>
		</ul>
    </div>
@endsection
