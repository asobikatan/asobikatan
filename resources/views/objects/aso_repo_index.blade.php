<h2>このあそびカタの「あそレポ」</h2>
@if($count > 0)
    <ul>
        @foreach($aso_repos as $aso_repo)
            <a href="/aso-repo/{{$aso_repo->id}}" style="text-decoration: none;">
                @if($loop->iteration % 3 == 0)
                    <li class="clearfix list_item aso_repo" style="margin-right: 0;">
                @else
                    <li class="clearfix list_item aso_repo">
                @endif
                    <img src="/img/aso_repo/{{$aso_repo->id}}_700.jpg">
                    @php
                        if($ua == 'objects.common' && mb_strlen($aso_repo->content, 'utf-8') > 50){
                            $aso_repo->content = mb_substr($aso_repo->content, 0, 48, "UTF-8");
                            $aso_repo->content .= "……";
                        }
                    @endphp
                    <p>{{($aso_repo->content)}}</p><br><u style="float:right;">続きを読む</u>
                </li>
            </a>
            @if($ua == 'sp_objects.common')
                @if(!isset($page) || $page == 0)
                    <?php break; ?>
                @endif
            @endif
        @endforeach
    </ul>
    @php
        if($ua == 'sp_objects.common'){
            $aso_repo_per_page = 1;
        }else{
            $aso_repo_per_page = 6;
        }
    @endphp
    @if($count > $aso_repo_per_page)
        @if(isset($page) && $page > 0)
        @else
            <a href="{{ Request::url()}}?page=1"><img src="/img/detail/more_aso_repo_btn.png" alt="あそレポを更に表示する" style="width: 100%; margin-top: 10px;"></a>
        @endif
    @endif
@else
    <p>まだ「あそレポ」は投稿されていないようです。</p>
@endif
<p>「{{$asobikata->name}}」で遊んだことがありますか？</p>
<a style="margin-bottom: 30px;" href="/aso-repo/create?aid={{$asobikata->id}}"><img src="/img/detail/post_btn.png" alt="あそレポを投稿する" style="width: 100%;"></a>
