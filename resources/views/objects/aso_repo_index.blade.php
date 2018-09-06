<h2>このあそびカタの「あそレポ」</h2>
@if($count > 0)
    <ul class="flow">
        @foreach($aso_repos as $aso_repo)
            <a href="/aso-repo/{{$aso_repo->id}}" style="text-decoration: none;">
                <li class="clearfix item">
                    <img src="/img/aso_repo/{{$aso_repo->id}}_700.jpg" style="width: 80px;">
                    @php
                        if($ua == 'sp_objects.common' && mb_strlen($aso_repo->content, 'utf-8') > 45){
                            $aso_repo->content = mb_substr($aso_repo->content, 0, 43, "UTF-8");
                            $aso_repo->content .= "……";
                        }elseif($ua == 'objects.common' && mb_strlen($aso_repo->content, 'utf-8') > 100){
                            $aso_repo->content = mb_substr($aso_repo->content, 0, 98, "UTF-8");
                            $aso_repo->content .= "……";
                        }
                    @endphp
                    <p>{{($aso_repo->content)}} <u>続きを読む</u></p>
                </li>
            </a>
        @endforeach
    </ul>
    @if($count > 5)
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
