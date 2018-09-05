@extends('objects.common')
@section('title')
    あそびカタン。| 日常をちょっと楽しく。
@endsection

@section('contents')
    @if($mode == 'deleted' || $mode == 'restore_failed')
        <link rel="stylesheet" href="/css/modai.css">
        <div class="modal">
          <input id="modal-trigger" class="checkbox" type="checkbox" checked="checked">
          <div class="modal-overlay">
           <label for="modal-trigger" class="o-close"></label>
           <div align="center" class="modal-wrap">
              <label for="modal-trigger" class="close">&#10006;</label>
              @if($mode == 'deleted')
                  @if($restore_id == 'false')
                      <p>削除に失敗しました</p>
                  @else
                      <p>削除に成功しました。</p>
                      <p>復元コード：{{$restore_id}}</p>
                      <a href="/article/restore?restore_id={{$restore_id}}">今すぐ復元する</a>
                  @endif
              @elseif($mode == 'restore_failed')
                  <p>復元に失敗しました</p>
                  <p>注：記事の復元は、記事を投稿したアカウントからのみ行えます。</p>
              @elseif($mode == 'edit_failed')
                  <p>編集に失敗しました</p>
                  <p>注：記事の編集は、記事を投稿したアカウントからのみ行えます。</p>
              @endif
              </div>
         </div>
        </div>
        <label for="modal-trigger"></label>
    @endif

    @include('objects.category')

    <img onerror="this.src='/img/noimg.jpg';" src="/img/top/finding02.png" width="164" height="37">
    <div class="border_box">
        <div class="border_body">
            @foreach($asobikatas as $asobikata)
                <!--　人気内容 -->
                <div class="popular_item">
                    <ul>
                        <li class="floatLeft">
                            <h3><a href="/article/{{$asobikata->id}}">{{$asobikata->a_name}}</a></h3>
                            @php
                                if(mb_strlen($asobikata->outline, 'utf-8') > 72){
                                    $asobikata->outline = mb_substr($asobikata->outline, 0, 70, "UTF-8");
                                    $asobikata->outline .= "……";
                                }
                            @endphp
                            <p>{{$asobikata->outline}}</p>
                        </li>
                        <li class="floatRight nice_btn"><iframe src="/yattemitai?id={{$asobikata->id}}&mode=ydisp_list" name="yattemitai" width="100px" height="110px" frameborder="0" allowtransparency='true'　style="margin: 0;"></iframe></li>
                    </ul>
                    <p class="user"><img onerror="this.src='/img/noimg.jpg';" src="/img/user/{{$asobikata->user_id}}_20x20.jpg"><a href="/user/{{$asobikata->login_id}}/">{{$asobikata->user_name}}</a></p>
                    <div class="category">
                        @include('objects.categories')
                    </div>
                </div>
            @endforeach
            <!--　人気内容　おわり -->
            <a href="/article"><img onerror="this.src='/img/noimg.jpg';" src="/img/top/popular_btn.png" alt="もっと人気の遊びを見る" width="639" height="65" class="roll"></a>
        </div>
    </div>
    <a href="/article/create"><img onerror="this.src='/img/noimg.jpg';" src="/img/detail/recruitment_btn.png" alt="あそびかたを投稿する" width="700"></a>
@endsection

@section('side')
    @include('objects.ad')
    @include('objects.sns')
@endsection
