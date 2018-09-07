@extends($ua)

@section('title')
    あそレポを投稿する| 日常をちょっと楽しく。
@endsection

@section('contents')
    @if($ua == 'sp_objects.common' && isset($aso_repo))
        @include('sp_objects.only_pc')
    @else
        @if($ua == 'objects.common')
            @if(isset($aso_repo))
                <a href="/">TOP</a> ＞　あそレポを編集する
            @else
                <a href="/">TOP</a> ＞　あそレポを投稿する
            @endif
        @endif

        @if(count($errors) > 0)
            <p class="error">入力に問題があります。再入力してください。</p>
        @else
            <link rel="stylesheet" href="/css/modai.css">
            <div class="modal">
                <input id="modal-trigger" class="checkbox" type="checkbox" checked="checked">
                <div class="modal-overlay">
                    <div align="center" class="modal-wrap">
                        <div class="border_box">
                            <div class="border_body">
                                @if($ua == 'objects.common')
                                    <img class="floatLeft" src="/img/form/main01.png">
                                @endif
                                @if(!isset($aso_repo))
                                    あそレポの投稿に興味を持っていただき、</br>ありがとうございます！</br>
                                @endif
                                以下のルールを守って投稿してください。</br></br>
                                <ul><li>公序良俗に反する書き込みはやめましょう。</li>
                                <li>著作権を侵害することはやめましょう。</li>
                                <li>その他<a href="/kiyaku/" target="_blank">利用規約</a>に反する書き込みは削除することがあります。</li></ul>
                                </br><label for="modal-trigger"><img class="btn" src="/img/form/open.png" width="214" height="50" class="roll" /></label>
                            </div>
                        </div>
                        </br><a href="/">TOPへ</a>
                    </div>
                </div>
            </div>
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
                    src="/aso-repo/img-create?aid={{$aid}}&ua={{$ua}}"
                    name="aso_repo_content"
                    style="border: 0; height: 100px; margin: 0;"
                    class="item"
                    scrolling="no"
                    frameborder="1"></iframe>
                <p style="padding: 5px;">imgタグ、aタグ、strongタグ、strikeタグ、pタグがお使いになれます。</p>
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
        </div>
    @endif
@endsection

@section('side')
    @include('objects.ad')
    @include('objects.sns')
@endsection
