@if(!isset($page) || $page == 0)
    @if(Request::path() == '/')
        @if($ua == 'sp_objects.common')
            <h2>新着の「あそレポ」</h2>
        @else
            <div style="border-bottom: solid 1px #B3CA64; margin: 20px 0;"><img onerror="this.src='/img/noimg.jpg';" src="/img/top/new_aso_repos.png" width="327" height="60"></div>
        @endif
    @else
        <h2>このあそびカタの「あそレポ」</h2>
    @endif
@endif
<div>
@if($count > 0)
    <ul class="clearfix">
        @foreach($aso_repos as $aso_repo)
            <a href="/aso-repo/{{$aso_repo->id}}" style="text-decoration: none;">
                @if($loop->iteration % 3 == 0)
                    <li class="clearfix aso_repo" style="margin-right: 0;">
                @else
                    <li class="clearfix aso_repo">
                @endif
                    {{substr($aso_repo->created_at, 0, 10)}}
                    <img src="/img/aso_repo/{{$aso_repo->id}}_700.jpg">
                    @php
                        if($ua == 'objects.common' && mb_strlen($aso_repo->content, 'utf-8') > 33){
                            $aso_repo->content = mb_substr($aso_repo->content, 0, 31, "UTF-8");
                            $aso_repo->content .= "……";
                        }elseif($ua == 'sp_objects.common' && mb_strlen($aso_repo->content, 'utf-8') > 33){
                            $aso_repo->content = mb_substr($aso_repo->content, 0, 31, "UTF-8");
                            $aso_repo->content .= "……";
                        }
                    @endphp
                    @if($ua == 'sp_objects.common')
                        <p style="margin: 0; height: 30px; font-size: 60%;">{{($aso_repo->content)}}</p>
                    @else
                        <p style="margin: 0;">{{($aso_repo->content)}}</p>
                    @endif
                    <u style="float:right;">続きを読む</u><br>
                    <p class="aso_repo_user"><img src="/img/user/{{$aso_repo->user_id}}_20x20.jpg" style="width: 20px; height: 20px; object-fit: contain;">{{$aso_repo->user_name}}さん</p>

                </li>
            </a>
            @if($ua == 'sp_objects.common' && $loop->index == 1)
                @if(!isset($page) || $page == 0)
                    <?php break; ?>
                @endif
            @endif
        @endforeach
    </ul>
    @php
        if($ua == 'sp_objects.common'){
            $aso_repo_per_page = 2;
        }else{
            $aso_repo_per_page = 6;
        }
    @endphp
    @if($count > $aso_repo_per_page)
        @if(isset($page) && $page > 0)
        @else
            @if($ua == 'sp_objects.common')
                <a class="misc-btn" style="margin: 10%;" href="{{ Request::url()}}?page=1">あそレポを更に表示する</a>
            @else
                <a href="{{ Request::url()}}?page=1"><img src="/img/detail/more_aso_repo_btn.png" alt="あそレポを更に表示する" style="width: 100%; margin-top: 10px;"></a>
            @endif
        @endif
    @endif
@else
    <p>まだ「あそレポ」は投稿されていないようです。</p>
@endif
@if(Request::path() != '/')
    <p>「あそレポ」を投稿して「{{$asobikata->name}}」の感想を共有しよう！</p>
    @if($ua == 'sp_objects.common')
        <a class="misc-btn" style="margin-bottom: 10%;" href="/aso-repo/create?aid={{$asobikata->id}}">あそレポを投稿する</a>
    @else
        <a style="margin-bottom: 30px;" href="/aso-repo/create?aid={{$asobikata->id}}"><img src="/img/form/post3_btn.png" alt="あそレポを投稿する" style="width: 100%;"></a>
    @endif
@endif
</div>
