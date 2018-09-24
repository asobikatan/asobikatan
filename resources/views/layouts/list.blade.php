@extends('objects.common')


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
        <a href="/">TOP</a> ＞　{{$category}}
        <h2>{{$category}}</h2>
    @elseif(isset($aso_repos))
        @if(Request::path() == '/')
            <a href="/">TOP</a> ＞　新着あそレポの一覧
        @else
            <a href="/">TOP</a> ＞　<a href="/user/{{$login_id}}/">{{$user_name}}さんのあそび</a>　＞　<a href="/article/{{$asobikata->id}}/">{{$asobikata->name}}</a>　＞　あそレポ一覧
        @endif
    @elseif(isset($user_name))
        @php
            if(mb_strlen($user_name, 'utf-8') > 11){
                $s_user_name = mb_substr($user_name, 0, 9, "UTF-8");
                $s_user_name = $s_user_name . "……";
            }else{
                $s_user_name = $user_name;
            }
        @endphp
        <a href="/">TOP</a> ＞　{{$user_name}}さんのあそび
        <h2>{{$s_user_name}}さんのあそび</h2>
    @else
        <a href="/">TOP</a> ＞ あそびの一覧
        <h2>あそびの一覧</h2>
    @endif

    <ul class="search_head">
        <li class="floatLeft">{{$count}}件</li>
        <li class="order"></li>
    </ul>
    @if(isset($asobikatas))
        @foreach($asobikatas as $asobikata)
            <!--　人気内容 -->
            <div class="clearfix list_item">
                <ul>
                    <li class="photo">
                        <div class="photoframe">
                            <a href="/article/{{$asobikata->id}}">
                                @if($asobikata->main_pic == 0 || $asobikata->main_pic == null)
                                    <img onerror="this.src='/img/noimg.jpg';" src="/img/asobi/{{$asobikata->id}}/main_200x200.jpg" class="imgft" style="width: 200px; margin-top: 2px;">
                                @else
                                    <img onerror="this.src='/img/noimg.jpg';" src="/img/asobi_def/def_{{$asobikata->main_pic}}.png" class="imgft" style="width: 200px; margin-top: 2px;">
                                @endif
                            </a>
                        </div>
                    </li>
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
                    <li class="floatRight nice_btn"><iframe src="/yattemitai?id={{$asobikata->id}}&mode=ydisp_list" name="yattemitai" width="106px" frameborder="0" allowtransparency='true'　style="margin: 0;"></iframe></li>
                </ul>
                <p class="user"><img onerror="this.src='/img/noimg.jpg';" src="/img/user/{{$asobikata->user_id}}_20x20.jpg"><a href="/user/{{$asobikata->login_id}}/">{{$asobikata->user_name}}</a></p>
                <div class="category">
                    @include('objects.categories')
                </div>
            </div>
        @endforeach
    @elseif(isset($aso_repos))
        @include('objects.aso_repo_index')
    @endif
    <!--　人気内容　おわり -->
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
    <a href="/article/create"><img onerror="this.src='/img/noimg.jpg';" src="/img/detail/recruitment_btn.png" alt="あそびかたを投稿する" width="700"></a>
@endsection

@section('side')
    @include('objects.ad')
    @if(isset($user_name))
        @include('objects.user')
    @endif
    @include('objects.sns')
@endsection
