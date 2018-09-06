@php
    if(isset($sim_asobikatas)){
        $asobikatas = $sim_asobikatas;
    }
@endphp

@if(isset($asobikatas))
    @foreach($asobikatas as $asobikata)
        <!--　人気内容 -->
        <a class="list_item clearfix" href="/article/{{$asobikata->id}}">
            @if($asobikata->main_pic == 0 || $asobikata->main_pic == null)
                <img onerror="this.src='/img/noimg.jpg';" src="/img/asobi/{{$asobikata->id}}/main_200x200.jpg">
            @else
                <img onerror="this.src='/img/noimg.jpg';" src="/img/asobi_def/def_{{$asobikata->main_pic}}.png">
            @endif
            <h4>{{$asobikata->a_name}}</h4>
            <p>{{$asobikata->outline}}</p>
        </a>
    @endforeach
    <div style="height: 10%"></div>
@endif
