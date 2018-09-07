@extends('objects.common')

@section('title')
    あそびカタン。| 日常をちょっと楽しく。
@endsection

@section('contents')
    <a class="link" href="/">TOPへ</a>
    <h1>問題が発生しました。やり直してください。</h1>
    <p>{{$exception}}</p>
@endsection

@section('side')
    @include('objects.ad')
    @include('objects.sns')
@endsection
