@extends($ua)

@section('title')
    あそレポを投稿する| 日常をちょっと楽しく。
@endsection

@section('contents')
    @if($ua == 'objects.common')
        <a href="/">TOPへ</a> | <a href="{{url()->previous()}}">前のページへ</a>
    @else
        <a class="link" href="{{url()->previous()}}">前のページへ</a>
    @endif

    <h2>「あそレポ（文章）」を投稿しよう！</h2>
        <div>
            <p>文字と画像で楽しさを共有するにはこちらから。</p>
            <a href='/aso-repo/15'><img src='/img/form/sample_aso_repo.png' alt='掲載例' class="point" style="width: 100%; padding:0;"></a>
            <a style="margin-bottom: 30px;" href="/aso-repo/create?aid={{$aid}}"><img src="/img/form/report_aso_repo.png" alt="あそレポ（文章）を投稿する" style="width: 100%;"></a>
        </div>

    <h2>「あそレポ（動画）」を投稿しよう！</h2>
    <div>
        <p>「あそびカタチャンネル」を使って、動画で楽しさを共有するにはこちらから。</p>

        <a style="margin-bottom: 30px;" href="/aso-repo/mov-create/{{$aid}}"><img src="/img/form/movie_aso_repo.png" alt="あそレポ（動画）を投稿する" style="width: 100%;"></a>
    </div>

@endsection

@section('side')
    @include('objects.ad')
    @include('objects.sns')
@endsection
