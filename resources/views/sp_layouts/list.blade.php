@extends('sp_objects.common')

@section('title')
    @if(isset($category))
        {{$category}}| 日常をちょっと楽しく。
    @elseif(isset($aso_repos))
        @if(Request::path() == '/')
            【遊んでみた】新着あそレポの一覧| 日常をちょっと楽しく。
        @else
            【遊んでみた】{{$asobikata->name}}【あそレポ】| 日常をちょっと楽しく。
        @endif
    @elseif(isset($user_name))
        {{$user_name}}さんのあそび| 日常をちょっと楽しく。
    @else
        あそびの一覧| 日常をちょっと楽しく。
    @endif
@endsection

@section('contents')
    @if(isset($category))
        <a class="link" href="/category/list">他のカテゴリへ</a>
        <h3>{{$category}}</h3>
    @elseif(isset($aso_repos))
        @if(Request::path() == '/')
            <a class="link" href="/">TOPへ</a>
            <h2>新着あそレポの一覧</h2>
        @else
            <a class="link" href="{{ Request::url()}}">{{$asobikata->name}}へ</a>
        @endif
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
    @if(isset($aso_repos))
        @include('objects.aso_repo_index')
    @endif
    <div class="page">
        @php
            if(isset($aso_repos)){
                $articles_per_page = 18;
            }else{
                $articles_per_page = 20;
            }
            $page_max = ceil($count / $articles_per_page) - 1;
            $last_page_count = $count - $page_max * $articles_per_page;
            if(isset($aso_repos)){
                $page_max += 1;
            }
        @endphp
        @if(isset($aso_repos))
            @if($page > 1)
                <a class="prev" href="{{ Request::url()}}?page={{$page - 1}}">＜前の{{$articles_per_page}}件</a>
            @endif
        @elseif($page > 0)
            <a class="prev" href="{{ Request::url()}}?page={{$page - 1}}">＜前の{{$articles_per_page}}件</a>
        @endif
        @if($page < $page_max - 1)
            <a class="next" href="{{ Request::url()}}?page={{$page + 1}}">次の{{$articles_per_page}}件＞</a>
        @elseif($page == $page_max - 1)
            <a class="next" href="{{ Request::url()}}?page={{$page + 1}}">次の{{$last_page_count}}件＞</a>
        @endif
    </div>
@endsection

@section('footer')
    @include('sp_objects.footer')
@endsection
