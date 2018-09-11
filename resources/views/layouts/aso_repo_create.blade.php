@extends($ua)

@section('title')
    @if(!isset($aso_repo))
        あそレポを投稿する | 日常をちょっと楽しく。
    @elseif($ua == 'sp_objects.common')
        パソコンから操作してください | 日常をちょっと楽しく。
    @else
        あそレポを編集する | 日常をちょっと楽しく。
    @endif
@endsection

@section('contents')
    @if($ua == 'sp_objects.common' && isset($aso_repo))
        @include('sp_objects.only_pc')
    @else
        @if($ua == 'objects.common')
            @if(isset($aso_repo))
                <a href="/">TOP</a> ＞　あそレポを編集する
            @else
                <a href="/">TOP</a> ＞　<a href="/user/{{$login_id}}/">{{$user_name}}さんのあそび</a>　＞　<a href="/article/{{$asobikata->id}}/">{{$asobikata->name}}</a> ＞　あそレポを投稿する
            @endif
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

        <form action="/aso-repo" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="user_id" value="{{$session_user->id}}">
            @if(isset($aso_repo))
                <input type="hidden" name="id" value="{{$aso_repo->id}}">
            @else
                <input type="hidden" name="asobikata_id" value="{{$aid}}">
            @endif

            <h2>見出し画像を投稿しよう！</h2>
            <div>
                @if(isset($aso_repo))
                    <img src="/img/aso_repo/{{$aso_repo->id}}_700.jpg" width="50px"><br>
                    画像を変更する場合は、新たな画像を投稿してください。
                @endif
                @if(count($errors) > 0)
                    <div class="error">再度指定してください。</div>
                    <div class="error">{{$errors->first("main_pic")}}</div>
                @endif
                <input type="file" accept="image/png, image/jpeg, image/gif" name="main_pic"><p style="padding: 5px;">
                @if(!isset($aso_repo))
                    ※必須項目　
                @endif
                ※10MByteまで</p><br>
            </div>

            <h2>楽しさを共有しよう！</h2>
            <div>
                画像を投稿して記事の中で使用しますか？<br>必要な場合はこちらから、1枚ずつ、複数枚投稿できます↓
                <iframe
                    id="content"
                    onLoad="adjust_frame_css(this.id)"
                    src="/aso-repo/img-create"
                    name="aso_repo_content"
                    style="border: 0; height: 100px; margin: 0;"
                    class="item"
                    scrolling="no"
                    frameborder="1"></iframe>
                <p style="margin: 5px;">imgタグ、aタグ、strongタグ、strikeタグ、pタグがお使いになれます。</p>
                @if($errors->has("content"))
                    <div class="error">{{$errors->first("content")}}</div>
                @endif
                @php
                    $placeholder = 'あれは去年の8月のことです。遅くまで仕事をしていて帰りが遅くなった私は、地方に住んでいたこともあり、バスの中に一人きりでした。しかし妙なんです。バスの中には私しかいないはずなのに、囁き声が聞こえてくるんです。気を紛らわしたかった私は、カバンの中から携帯電話を取り出し、あそびカタンであそびカタを探すことにしました。「車内でできる遊び」を探し、みんなで時の経つのも忘れて遊んでいました。あれ、そういえば私しかいなかったような……。';
                @endphp
                @if(isset($aso_repo))
                    <textarea rows="30" name="content" class="big-text" placeholder="{{$placeholder}}">{!!old('content', $aso_repo->content)!!}</textarea>
                @else
                    <textarea rows="30" name="content" class="big-text" placeholder="{{$placeholder}}">{!!old('content')!!}</textarea>
                @endif
                <input type="image" src="/img/form/post3_btn.png" alt="送信する" align="middle" class="post_btn">
            </div>
        </form>

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
    @endif
@endsection

@section('side')
    @include('objects.ad')
    @include('objects.sns')
@endsection
