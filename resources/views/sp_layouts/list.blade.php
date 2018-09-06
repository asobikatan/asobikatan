@extends('sp_objects.common')
@if(isset($category))
    @section('title')
        {{$category}}| 日常をちょっと楽しく。
    @endsection
@elseif(isset($user_name))
    @section('title')
        {{$user_name}}さんのあそび| 日常をちょっと楽しく。
    @endsection
@elseif(isset($aso_repos))
    @section('title')
        【遊んでみた】{{$asobikata->name}}【あそレポ】| 日常をちょっと楽しく。
    @endsection
@else
    @section('title')
        あそびの一覧| 日常をちょっと楽しく。
    @endsection
@endif

@section('contents')
    @if(isset($category))
        <a class="link" href="/category/list">他のカテゴリへ</a>
        <h3>{{$category}}</h3>
    @elseif(isset($user_name))
        <h3>{{$user_name}}さん</h3>
        <div class="item" style="margin-bottom: 0;">
            <a href="/user/{{$login_id}}/"><img onerror="this.src='/img/noimg.jpg';" src="/img/user/{{$user_id}}_50x50.jpg"></a>
            <a href="http://twitter.com/{{$login_id}}" target="_blank" rel="nofollow"><img onerror="this.src='/img/noimg.jpg';" src="/img/social_icon01.png" width="20" height="20"></a><br>
        </div>
        <h3>{{$user_name}}さんのあそび</h3>
    @else
        <h3>あそびカタの一覧</h3>
    @endif
    @include('sp_objects.list')
    <div class="page">
        @php
            $page_max = ceil($count / 20) - 1;
            $last_page_count = $count - $page_max * 20;
        @endphp
        @if($page > 0)
            <a style="float: left;" href="{{ Request::url()}}?page={{$page - 1}}">＜前の20件</a>
        @endif
        @if($page < $page_max - 1)
            <a style="float: right;" href="{{ Request::url()}}?page={{$page + 1}}">次の20件＞</a>
        @elseif($page == $page_max - 1)
            <a style="float: right;" href="{{ Request::url()}}?page={{$page + 1}}">次の{{$last_page_count}}件＞</a>
        @endif
    </div>
@endsection

@section('footer')
    @include('sp_objects.footer')
@endsection
