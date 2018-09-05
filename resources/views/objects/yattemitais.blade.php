<!-- やってみたい人 -->
<h3><img onerror="this.src='/img/noimg.jpg';" src="/img/side/find_nice.png" width="184" height="15"></h3>
<div id="letsPlay" class="side_back_g">
    <p>
        @foreach($yattemitais as $yattemitai)
            <a href="/user/{{$yattemitai->login_id}}"><img onerror="this.src='/img/noimg.jpg';" src="/img/user/{{$yattemitai->id}}_50x50.jpg"></a>
        @endforeach
    </p>
    <iframe src="/yattemitai?id={{$asobikata->id}}&mode=ydisp_detail" name="yattemitai" width="184" height="100" frameborder="0" allowtransparency='true'　style="margin: 0;"></iframe>
</div>
