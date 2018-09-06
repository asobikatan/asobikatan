@extends('objects.common')

@section('title')
    あそびカタの編集| 日常をちょっと楽しく。
@endsection

@section('contents')
    <a href="/">TOP</a> ＞　あそびを編集する

    @if(count($errors) > 0)
        <p class="error">入力に問題があります。再入力してください。</p>
    @else
        <link rel="stylesheet" href="/css/modai.css">
        <div class="modal">
            <input id="modal-trigger" class="checkbox" type="checkbox" checked="checked">
            <div class="modal-overlay">
                <div align="center" class="modal-wrap">
                    <div class="border_box">
                        <div class="clearfix border_body">
                            <img class="floatLeft" src="/img/form/main01.png">
                            以下のルールを守って投稿してください。</br></br>
                            <ul><li>公序良俗に反する書き込みはやめましょう。</li>
                            <li>著作権を侵害することはやめましょう。</li>
                            <li>その他<a href="/kiyaku/" target="_blank">利用規約</a>に反する書き込みは削除することがあります。</li></ul>
                            </br><label for="modal-trigger"><img class="btn" src="/img/form/open.png" width="214" height="50" class="roll" /></label>
                        </div>
                    </div>
                    </br><a href="/">TOPへ</a>
                </div>
            </div>
        </div>
    @endif
    <form action="/article" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="user_id" value="{{$session_user->id}}">
        <input type="hidden" name="id" value="{{$asobikata->id}}">

        <h2>あそびの内容</h2>
        <table class="form1">
            <tr><th>題名</th><td>
                @if($errors->has('name'))
                    <div class="error">{{$errors->first('name')}}</div>
                @endif
            <input type="text" name="name" value="{{old('name', $asobikata->name)}}"></td></tr>

            <tr><th>概要</th><td>
                @if($errors->has('outline'))
                    <div class="error">{{$errors->first('outline')}}</div>
                @endif
            <textarea rows="3" name="outline">{{old('outline', $asobikata->outline)}}</textarea></td></tr>
            @php
                $delete_pics_count = 12;
                for($i = 0; $i <= $delete_pics_count; $i++){
                    $delete_pics_checked[$i] = '';
                }
                if(old('delete_pics') !== null){
                    foreach(old('delete_pics') as $delete_pic){
                        $delete_pics_checked[$delete_pic] = 'checked="checked"';
                    }
                }
            @endphp
            <tr><th>手順</th><td>
                <div class="grad-wrap">
                    <input id="trigger1" class="grad-trigger" type="checkbox">
                    <div class="grad-item">
                        @if(count($errors) > 0)
                            <div class="error">画像をアップロードする場合、再度指定してください。</div>
                        @endif
                        @for($i = 1; $i <= 12; $i++)
                            <dl>
                                <dt>手順.{{$i}}</dt>
                                <dd>
                                    @if($asobikata->pics[$i] == true)
                                        <div style="float: right;">
                                            <div style="text-align: right; line-height: 100%; margin-right: 15px;">選択して削除</div>
                                            <input type="checkbox" name="delete_pics[]" value="{{$i}}" id="delete_pics_{{$i}}" {{$delete_pics_checked[$i]}}>
                                            <label for="delete_pics_{{$i}}"><img src="/img/asobi/{{$asobikata->id}}/{{$i}}_200x200.jpg" alt="選択すると赤枠で囲まれます。赤枠で囲まれたものは削除されます。"></label>
                                        </div>
                                    @endif
                                </dd>
                                <dd>
                                    @if($errors->has("contents_$i"))
                                        <div class="error">{{$errors->first("contents_$i")}}</div>
                                    @endif
                                <textarea rows="4" name="contents_{{$i}}">{{old("contents_$i", $asobikata->{"contents_$i"})}}</textarea></dd>
                                <dd>
                                    @if($errors->has("pics_$i"))
                                        <div class="error">{{$errors->first("pics_$i")}}</div>
                                    @else
                                        ※上書きする場合は指定（10MByteまで）
                                    @endif
                                <input type="file" accept="image/png, image/jpeg, image/gif" name="pics_{{$i}}" value="{{old('pics_$i')}}"></dd>
                            </dl>
                        @endfor
                    </div>
                    <label class="floatRight grad-btn" for="trigger1"><img src="/img/form/plus_btn.png"></label>
                </div>
            </td></tr>

            <tr><th>盛り上がりポイント</th><td>
                @if($errors->has('moripoint'))
                    <div class="error">{{$errors->first('moripoint')}}</div>
                @endif
            <textarea rows="3" name="moripoint">{{old('moripoint', $asobikata->moripoint)}}</textarea></td></tr>

            <tr><th>タイトル写真</th><td>
                <div class="grad-wrap">
                    <input id="trigger2" class="grad-trigger" type="checkbox">
                    <div class="grad-item">
                        @php
                            $pics_count = 31;
                            for($i = 0; $i <= $pics_count; $i++){
                                $pics_checked[$i] = '';
                            }
                            if(old('main_pic') !== null){
                                $pics_checked[old('main_pic')] = 'checked="checked"';
                                $rand = old('main_pic') - 1;
                            }elseif($asobikata->main_pic == 0){
                                $pics_checked[31] = 'checked="checked"';
                                $rand = $rand = rand(0,29);
                            }else{
                                $pics_checked[$asobikata->main_pic] = 'checked="checked"';
                                $rand = $asobikata->main_pic - 1;
                            }
                        @endphp
                        @if($errors->has('pics_0'))
                            <div class="error">{{$errors->first('pics_0')}}</div>
                        @elseif(count($errors) > 0)
                            <div class="error">画像をアップロードする場合、再度指定してください。</div>
                        @else
                            ※上書きする場合は指定（10MByteまで）
                        @endif
                        @if($errors->has('main_pic'))
                            <div class="error">{{$errors->first('main_pic')}}</div>
                        @endif
                        @if($asobikata->main_pic != 0)
                            <dd><input type="radio" name="main_pic" id="item_0" value="0">
                                <label for="dummy">
                                    <div id="openlocation"><a href="#lap"><img src="/img/form/refer_btn.png"></a>
                                        <div class="lap" id="lap">
                                            <a href="#openlocation" class="overlap">X</a>
                                            <div class="innerWindow">
                                                <input type="file" accept="image/png, image/jpeg, image/gif" name="pics_0"><br>
                                                <script type="text/javascript">
                                                    function man_pic(){
                                                        document.getElementById("item_0").checked = true;
                                                    }
                                                </script>
                                                <div class="floatRight">※10MByteまで</div>
                                                <a href="#openlocation" onClick="man_pic()">確定</a>
                                                <a href="#openlocation" onClick="man_pic()">X 閉じる</a>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </dd>
                        @else
                            @if($errors->has("pics_$i"))
                                <div class="error">{{$errors->first("pics_$i")}}
                            @endif
                            <script type="text/javascript">
                                function override_man_pic(){
                                    document.getElementById("item_0").checked = true;
                                }
                            </script>
                            <input type="file" accept="image/png, image/jpeg, image/gif" name="pics_0" onClick="override_man_pic()">
                            <dd><input type="radio" name="main_pic" id="item_31" value="31" {{$pics_checked[31]}}>
                                <label for="item_31"><img onerror="this.src='/img/noimg.jpg';" src="/img/asobi/{{$asobikata->id}}/main_200x200.jpg"></label>
                            </dd>
                        @endif
                        @for($i = 0; $i < 30; $i++)
                            <dd><input type="radio" name="main_pic" id="item_{{($i + $rand) % 30 + 1}}" value="{{($i + $rand) % 30 + 1}}" {{$pics_checked[($i + $rand) % 30 + 1]}}>
                                <label for="item_{{($i + $rand) % 30 + 1}}"><img src="/img/asobi_def/def_{{($i + $rand) % 30 + 1}}.png"></label>
                            </dd>
                        @endfor
                        @if($asobikata->main_pic == 0)
                            <input type="radio" name="main_pic" id="item_0" value="0" {{$pics_checked[0]}}>
                            <label for="item_0">画像を投稿</label>
                        @endif
                    </div>
                    <label class="floatRight grad-btn" for="trigger2">さらに表示</label>
                </div>
            </td></tr>
        </table>

        <h2>あそびの詳細情報</h2>
        <table class="form2">
            @php
                $place_type_count = 3;
                for($i = 0; $i <= $place_type_count; $i++){
                    $place_type_checked[$i] = '';
                }
                if(old('place_type') !== null){
                    $place_type_checked[old('place_type')] = 'checked="checked"';
                }else{
                    $place_type_checked[$asobikata->place_type] = 'checked="checked"';
                }
            @endphp
            <tr><th>場所</th><td>
                @if($errors->has('place_type'))
                    <div class="error">{{$errors->first('place_type')}}</div>
                @endif
                <input type="radio" name="place_type" value="1" {{$place_type_checked[1]}}>インドア　
                <input type="radio" name="place_type" value="2" {{$place_type_checked[2]}}>アウトドア　
                <input type="radio" name="place_type" value="3" {{$place_type_checked[3]}}>車内</br></br>
                @if($errors->has('place'))
                    <div class="error">{{$errors->first('place')}}</div>
                @endif
                具体的な場所があれば<input type="text" name="place" value="{{old('place', $asobikata->place)}}"></td></tr>

            @php
                $age_count = 3;
                for($i = 0; $i < $age_count; $i++){
                    $age_checked[$i] = '';
                }
                if(old('age') !== null){
                    $age_checked[old('age')] = 'checked="checked"';
                }elseif($asobikata->age_max <= 10){
                    $age_checked[1] = 'checked="checked"';
                }elseif($asobikata->age_min >= 20){
                    $age_checked[2] = 'checked="checked"';
                }else{
                    $age_checked[0] = 'checked="checked"';
                }
            @endphp
            <tr><th>対象年齢</th><td>
                @if($errors->has('age'))
                    <div class="error">{{$errors->first('age')}}</div>
                @endif
                <input type="radio" name="age" value="0" {{$age_checked[0]}}>年齢問わず　
                <input type="radio" name="age" value="1" {{$age_checked[1]}}>子ども向け　
                <input type="radio" name="age" value="2" {{$age_checked[2]}}>オトナ向け
            </td></tr>

            @php
                $detail_3_5_count = 3;
                for($i = 0; $i < $detail_3_5_count; $i++){
                    $detail_3_5_checked[$i] = '';
                }
                if(old('detail_3_5') !== null){
                    $detail_3_5_checked[old('detail_3_5')] = 'checked="checked"';
                }else{
                    $detail_3_5_checked[$asobikata->detail_3_5] = 'checked="checked"';
                }
            @endphp
            <tr><th>盛り上がる相手</th><td>
                @if($errors->has('detail_3_5'))
                    <div class="error">{{$errors->first('detail_3_5')}}</div>
                @endif
                <input type="radio" name="detail_3_5" value="0" {{$detail_3_5_checked[0]}}>性別問わず　
                <input type="radio" name="detail_3_5" value="1" {{$detail_3_5_checked[1]}}>特に異性と　
                <input type="radio" name="detail_3_5" value="2" {{$detail_3_5_checked[2]}}>特に同性と
            </td></tr>

            @php
                $number_count = 10;
                for($i = 1; $i <= $number_count; $i++){
                    $number_safe_min_selected[$i] = '';
                    $number_safe_max_selected[$i] = '';
                }
                $number_safe_min_selected[-1] = '';
                $number_safe_max_selected[9999] = '';
                if(old('number_safe_min') !== null){
                    $number_safe_min_selected[old('number_safe_min')] = "selected";
                }else{
                    $number_safe_min_selected[$asobikata->number_safe_min] = "selected";
                }
                if(old('number_safe_max') !== null){
                    $number_safe_max_selected[old('number_safe_max')] = "selected";
                }else{
                    $number_safe_max_selected[$asobikata->number_safe_max] = "selected";
                }
            @endphp
            <tr><th>人数</th><td>
                @if($errors->has('number_safe_min'))
                    <div class="error">{{$errors->first('number_safe_min')}}</div>
                @endif
                @if($errors->has('number_safe_max'))
                    <div class="error">{{$errors->first('number_safe_max')}}</div>
                @endif
                <select name="number_safe_min">
                    <option value="-1" {{$number_safe_min_selected[-1]}}>何人でも</option>
                    @for($i = 1; $i <= 9; $i++)
                        <option value="{{$i}}" {{$number_safe_min_selected[$i]}}>{{$i}}人</option>
                    @endfor
                    <option value="10" {{$number_safe_min_selected[10]}}>10人以上</option>
                </select>
                〜
                <select name="number_safe_max">
                    <option value="9999" {{$number_safe_max_selected[9999]}}>何人でも</option>
                    @for($i = 1; $i <= 9; $i++)
                        <option value="{{$i}}" {{$number_safe_max_selected[$i]}}>{{$i}}人</option>
                    @endfor
                    <option value="10" {{$number_safe_max_selected[10]}}>10人以上</option>
                </select>
                くらいで遊ぶと楽しい！
            </td></tr>

            @php
                $one_time_selected[1] = '';
                $one_time_selected[5] = '';
                $one_time_selected[10] = '';
                $one_time_selected[30] = '';
                $one_time_selected[60] = '';
                $one_time_selected[120] = '';
                $one_time_selected[999] = '';
                if(old('one_time') !== null){
                    $one_time_selected[old('one_time')] = "selected";
                }else{
                    $one_time_selected[$asobikata->one_time] = "selected";
                }
            @endphp
            <tr><th>かかる時間</th><td>
                @if($errors->has('one_time'))
                    <div class="error">{{$errors->first('one_time')}}</div>
                @endif
                <select name="one_time">
                    <option value="1" {{$one_time_selected[1]}}>1分以内</option>
                    <option value="5" {{$one_time_selected[5]}}>5分以内</option>
                    <option value="10" {{$one_time_selected[10]}}>10分以内</option>
                    <option value="30" {{$one_time_selected[30]}}>30分以内</option>
                    <option value="60" {{$one_time_selected[60]}}>1時間以内</option>
                    <option value="120" {{$one_time_selected[120]}}>2時間以内</option>
                    <option value="999" {{$one_time_selected[999]}}>2時間以上</option>
                </select>
            </td></tr>

            <tr><th>費用</th><td>
                @if($errors->has('price'))
                    <div class="error">{{$errors->first('price')}}</div>
                @endif
                @if(isset($asobikata->price))
                    <input type="tel" name="price" value="{{old('price', $asobikata->price)}}" placeholder="0">円くらい</td></tr>
                @else
                    <input type="tel" name="price" value="{{old('price')}}" placeholder="0">円くらい</td></tr>
                @endif

            <tr><th>必要な道具</th><td>
                @if($errors->has('tools'))
                    <div class="error">{{$errors->first('tools')}}</div>
                @endif
                @if(isset($asobikata->tools))
                    <input type="text" name="tools" value="{{old('tools', $asobikata->tools)}}" placeholder="ある場合"></td></tr>
                @else
                    <input type="text" name="tools" value="{{old('tools')}}" placeholder="ある場合"></td></tr>
                @endif
        </table>
        <input type="image" src="/img/form/post_btn.png" alt="送信する" align="middle" class="post_btn">
    </form>
@endsection

@section('side')
    @include('objects.ad')
    @include('objects.sns')
@endsection
