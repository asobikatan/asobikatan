@extends('sp_objects.common')
@section('title')
    あそびカタン。| 日常をちょっと楽しく。
@endsection

@section('contents')
    <a class="link" href="/category/list">カテゴリから選ぶ</a>
    <h3>人気のあそびカタ。</h3>
    @include('sp_objects.list')
    <a class="misc-btn" href="/article">もっと記事を読み込む</a>
@endsection

@section('footer')
    @include('sp_objects.footer')
@endsection
