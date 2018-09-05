@extends('sp_objects.common')

@section('title')
    あそびカタの登録| 日常をちょっと楽しく。
@endsection

@section('contents')
    @if(count($errors) > 0)
        <p class="error">入力に問題があります。再入力してください。</p>
    @else
        <link rel="stylesheet" href="/css/modai.css">
        <div class="modal" style="height:0; padding: 0;">
            <input id="modal-trigger" class="checkbox" type="checkbox" checked="checked">
            <div class="modal-overlay" style="padding: 0;">
                <div align="center" class="modal-wrap">
                    <div class="border_box">
                        あそびかたの投稿に興味を持っていただき、ありがとうございます！以下のルールを守って投稿してください。</br></br>
                        <ul><li>公序良俗に反する書き込みはやめましょう。</li>
                        <li>著作権を侵害することはやめましょう。</li>
                        <li>その他<a href="/kiyaku/" target="_blank">利用規約</a>に反する書き込みは削除することがあります。</li></ul>
                        </br><label for="modal-trigger"><img class="btn" src="/img/form/open.png" width="40%" class="roll" /></label>
                    </div>
                    </br><a href="/">TOPへ</a>
                </div>
            </div>
        </div>
    @endif
    <form action="/article" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="user_id" value="{{$session_user->id}}">

        <h2>題名</h2>
            @if($errors->has('name'))
                <div class="error">{{$errors->first('name')}}</div>
            @endif
            <input type="text" name="name" value="{{old('name')}}" placeholder="例：ひとり鬼ごっこ">

        <h2>概要</h2>
            @if($errors->has('outline'))
                <div class="error">{{$errors->first('outline')}}</div>
            @endif
            <textarea rows="3" name="outline" placeholder="例：深夜にひとりで鬼ごっこをします。">{{old('outline')}}</textarea>

        <h2>手順</h2>
            <div class="grad-wrap" style="padding: 0; width: 100%;">
                <input id="trigger1" class="grad-trigger" type="checkbox">
                <div class="grad-item" style="padding: 0; width: 100%;">
                    @for($i = 1; $i <= 12; $i++)
                        @if($errors->has("contents_$i"))
                            <div class="error">{{$errors->first("contents_$i")}}</div>
                        @endif
                        <textarea rows="4" name="contents_{{$i}}" placeholder="手順{{$i}}">{{old("contents_$i")}}</textarea>
                    @endfor
                </div>
                <label class="grad-btn" style="float:right;" for="trigger1"><img src="/img/form/plus_btn.png"></label>
            </div>

        <h2>盛り上がりポイント</h2>
            @if($errors->has('moripoint'))
                <div class="error">{{$errors->first('moripoint')}}</div>
            @endif
            <textarea rows="3" name="moripoint" placeholder="例：3人目が出てきて追いかけてきたとき">{{old('moripoint')}}</textarea>

        <h2>タイトル写真</h2>
            <p>パソコンからは、オリジナルの写真を投稿できます。</br>
            あとから変更できますので、ぜひパソコンから写真を投稿してみてくださいね。</p>
            <div class="grad-wrap" style="padding: 0 0 0 2.5%; width: 97.5%;">
                <input id="trigger2" class="grad-trigger" type="checkbox">
                <div class="grad-item" style="padding: 0; width: 100%;">
                    @php
                        $pics_count = 30;
                        for($i = 0; $i <= $pics_count; $i++){
                            $pics_checked[$i] = '';
                        }
                        $rand = rand(0,29);
                        if(old('main_pic') !== null){
                            $pics_checked[old('main_pic')] = 'checked="checked"';
                            $rand = old('main_pic') - 1;
                        }
                    @endphp
                    @if($errors->has('main_pic'))
                        <div class="error">{{$errors->first('main_pic')}}</div>
                    @endif
                    @for($i = 0; $i < 30; $i++)
                        <input type="radio" name="main_pic" id="item_{{($i + $rand) % 30 + 1}}" value="{{($i + $rand) % 30 + 1}}" {{$pics_checked[($i + $rand) % 30 + 1]}}>
                        <label for="item_{{($i + $rand) % 30 + 1}}"><img width="100%" src="/img/asobi_def/def_{{($i + $rand) % 30 + 1}}.png"></label>
                    @endfor
                </div>
                <label class="grad-btn" style="float:right;" for="trigger2">さらに表示</label>
            </div>

            @php
                $place_type_count = 2;
                for($i = 0; $i <= $place_type_count; $i++){
                    $place_type_checked[$i] = '';
                }
                if(old('place_type') !== null){
                    $place_type_checked[old('place_type')] = 'checked="checked"';
                }
                $car_checked = "";
                if(old('car') == 'true'){
                    $car_checked = 'checked="checked"';
                }
            @endphp
        <h2>場所</h2>
            <div class="item" style="padding-left: 7.5%; width: 87.5%;">
                @if($errors->has('place_type'))
                    <div class="error">{{$errors->first('place_type')}}</div>
                @endif
                    <input type="radio" name="place_type" value="1" id="place_type_1" {{$place_type_checked[1]}}><label class="misc-btn" for="place_type_1">室内</label>
                    <input type="radio" name="place_type" value="2" id="place_type_2" {{$place_type_checked[2]}}><label class="misc-btn" for="place_type_2">アウトドア</label>
                    <input type="checkbox" name="car" value="true" id="place_type_3" {{$car_checked}}><label for="place_type_3">車内でも</label>
                @if($errors->has('place'))
                    <div class="error">{{$errors->first('place')}}</div>
                @endif
                <input type="text" style=" width: 92%; margin: 0;" name="place" placeholder="具体的な場所があれば" value="{{old('place')}}">
            </div>

        @php
            $age_count = 3;
            for($i = 0; $i < $age_count; $i++){
                $age_checked[$i] = '';
            }
            if(old('age') !== null){
                $age_checked[old('age')] = 'checked="checked"';
            }
        @endphp
        <h2>対象年齢</h2>
            <div class="item clearfix" style="padding-left: 7.5%; width: 87.5%;">
                @if($errors->has('age'))
                    <div class="error">{{$errors->first('age')}}</div>
                @endif
                <input type="radio" name="age" value="0" id="age_0" {{$age_checked[0]}}><label class="misc-btn" for="age_0">年齢問わず</label>
                <input type="radio" name="age" value="1" id="age_1" {{$age_checked[1]}}><label class="misc-btn" for="age_1">子ども向け</label>
                <input type="radio" name="age" value="2" id="age_2" {{$age_checked[2]}}><label class="misc-btn" for="age_2">オトナ向け</label>
            </div>

        @php
            $detail_3_5_count = 3;
            for($i = 0; $i < $detail_3_5_count; $i++){
                $detail_3_5_checked[$i] = '';
            }
            if(old('detail_3_5') !== null){
                $detail_3_5_checked[old('detail_3_5')] = 'checked="checked"';
            }
        @endphp
        <h2>盛り上がる相手</h2>
        <div class="item clearfix" style="padding-left: 7.5%; width: 87.5%;">
            @if($errors->has('detail_3_5'))
                <div class="error">{{$errors->first('detail_3_5')}}</div>
            @endif
            <input type="radio" name="detail_3_5" value="0" id="detail_3_5_0" {{$detail_3_5_checked[0]}}><label class="misc-btn" for="detail_3_5_0">性別問わず</label>
            <input type="radio" name="detail_3_5" value="1" id="detail_3_5_1" {{$detail_3_5_checked[1]}}><label class="misc-btn" for="detail_3_5_1">特に異性と</label>
            <input type="radio" name="detail_3_5" value="2" id="detail_3_5_2" {{$detail_3_5_checked[2]}}><label class="misc-btn" for="detail_3_5_2">特に同性と</label>
        </div>

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
            }
            if(old('number_safe_max') !== null){
                $number_safe_max_selected[old('number_safe_max')] = "selected";
            }
        @endphp
        <h2>人数</h2>
        <div class="item clearfix" style="text-align: center;">
            @if($errors->has('number_safe_min'))
                <div class="error">{{$errors->first('number_safe_min')}}</div>
            @endif
            @if($errors->has('number_safe_max'))
                <div class="error">{{$errors->first('number_safe_max')}}</div>
            @endif
            <select name="number_safe_min">
                <option value="-1" {{$number_safe_min_selected[-1]}}>何人でも▼</option>
                @for($i = 1; $i <= 9; $i++)
                    <option value="{{$i}}" {{$number_safe_min_selected[$i]}}>{{$i}}人</option>
                @endfor
                <option value="10" {{$number_safe_min_selected[10]}}>10人以上</option>
            </select>
            〜
            <select name="number_safe_max">
                <option value="9999" {{$number_safe_max_selected[9999]}}>何人でも▼</option>
                @for($i = 1; $i <= 9; $i++)
                    <option value="{{$i}}" {{$number_safe_max_selected[$i]}}>{{$i}}人</option>
                @endfor
                <option value="10" {{$number_safe_max_selected[10]}}>10人</option>
            </select>
        </br><div style="text-align: right;">くらいで遊ぶと楽しい！</div>
        </div>

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
            }
        @endphp
        <h2>かかる時間</h2>
        <div class="item clearfix">
            @if($errors->has('one_time'))
                <div class="error">{{$errors->first('one_time')}}</div>
            @endif
            <select name="one_time" style="width: 95%;">
                <option value="1" {{$one_time_selected[1]}}>1分以内▼</option>
                <option value="5" {{$one_time_selected[5]}}>5分以内</option>
                <option value="10" {{$one_time_selected[10]}}>10分以内</option>
                <option value="30" {{$one_time_selected[30]}}>30分以内</option>
                <option value="60" {{$one_time_selected[60]}}>1時間以内</option>
                <option value="120" {{$one_time_selected[120]}}>2時間以内</option>
                <option value="999" {{$one_time_selected[999]}}>2時間以上</option>
            </select>
        </div>

        <h2>費用</h2>
        <div class="item clearfix">
            @if($errors->has('price'))
                <div class="error">{{$errors->first('price')}}</div>
            @endif
            <input style="width: 60%; margin: 0 2.5%;" type="tel" name="price" value="{{old('price')}}" placeholder="0">円くらい
        </div>

        <h2>必要な道具</h2>
        <div class="item clearfix" style="border-bottom: none; margin: 0;">
            @if($errors->has('tools'))
                <div class="error">{{$errors->first('tools')}}</div>
            @endif
            <input type="text" name="tools" value="{{old('tools')}}" placeholder="ある場合">
        </div>
        <input type="submit" class="misc-btn" alt="送信する">
    </form>
@endsection
