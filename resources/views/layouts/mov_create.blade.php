@extends($ua)

@section('title')
    「あそびカタチャンネル」に投稿する| 日常をちょっと楽しく。
@endsection

@section('contents')
    @if($ua == 'objects.common')
        <a href="/">TOP</a> ＞　<a href="/user/{{$login_id}}/">{{$user_name}}さんのあそび</a>　＞　<a href="/article/{{$asobikata->id}}/">{{$asobikata->name}}</a> ＞　あそレポを投稿する
    @else
        <a class="link" href="/article/{{$asobikata->id}}">{{$asobikata->name}}へ</a>
    @endif

    @if(count($errors) > 0)
        <p class="error">入力に問題があります。再入力してください。</p>
    @else
        @component('objects.notice_form')
            @slot('msg')
                @if(!isset($aso_repo))
                    あそレポの投稿に興味を持っていただき、</br>ありがとうございます！</br>
                @endif
            @endslot
            @slot('ua')
                {{$ua}}
            @endslot
        @endcomponent
    @endif

    <form action="/aso-repo/mov-create" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="user_id" value="{{$session_user->id}}">
        <input type="hidden" name="user_name" value="{{$session_user->name}}">
        <input type="hidden" name="asobikata_id" value="{{$aid}}">
        <input type="hidden" name="asobikata_name" value="{{$asobikata->name}}">

        <h2>動画を投稿しよう！</h2>
        <div class="play_list">
            @if(count($errors) > 0)
                <div class="error">再度指定してください。</div>
                <div class="error">{{$errors->first("movie")}}</div>
            @endif
            <input type="file" name="movie" accept="video/quicktime, video/mp4, video/x-msvideo, video/x-ms-wmv, video/MP2P, video/MP1S, video/x-flv, video/3gpp, video/webm, video/hevc">
            ※必須項目　※1GByteまで
        </div>

        <h2>題名を決めよう！</h2>
        <div class="play_list">
            @if($errors->has("title"))
                <div class="error">{{$errors->first("title")}}</div>
            @endif
            <input type="text" name="title" style="width: 100%" value="{{old('title', '「' . $asobikata->name . '」で遊んで起きたこととは……？【あそレポ】')}}">
        </div>

        <h2>説明文を追加しよう！（任意）</h2>
        <div class="play_list">
            @if($errors->has("content"))
                <div class="error">{{$errors->first("content")}}</div>
            @endif
            @php
                $placeholder = 'あれは去年の8月のことです。遅くまで仕事をしていて帰りが遅くなった私は、地方に住んでいたこともあり、バスの中に一人きりでした。しかし妙なんです。バスの中には私しかいないはずなのに、囁き声が聞こえてくるんです。気を紛らわしたかった私は、カバンの中から携帯電話を取り出し、あそびカタンであそびカタを探すことにしました。「車内でできる遊び」を探し、みんなで時の経つのも忘れて遊んでいました。あれ、そういえば私しかいなかったような……。';
            @endphp
            <textarea rows="5" name="content" class="big-text" placeholder="{{$placeholder}}">{!!old('content')!!}</textarea>
        </div>

        <h2>タグを追加しよう！（任意）</h2>
        @if($errors->has("tags"))
            <div class="error">{{$errors->first("tags")}}</div>
        @endif
        <p style="margin: 5px;">,（半角カンマ）で区切ると複数登録できます。</p>
        <div class="play_list">
            <input type="text" name="tags" style="width: 100%" placeholder="例: アルバート・アインシュタイン 空飛ぶ豚 マッシュアップ" value="{{old('tags')}}">
            <input type="image" src="/img/form/movie_aso_repo.png" alt="送信する" align="middle" class="post_btn" onClick='disp_loading();'>
        </div>
    </form>

    <!-- ↓ onClick='disp_loading();'を実現 -->
    @include('objects.loading')

@endsection

@section('side')
    @include('objects.ad')
    @include('objects.sns')
@endsection
