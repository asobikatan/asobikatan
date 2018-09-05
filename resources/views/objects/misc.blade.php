<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body{
            margin: 0;
            height: 100%;

            @if($mode == 'yinc_list' || $mode == 'ydisp_list' || $mode == 'yinc_detail' || $mode == 'ydisp_detail')
                background-color: transparent;
            @endif
        }

        .nice_btn a {
            background: url(/img/nice_btn.png) no-repeat center 4px;
            padding-top: 8px;
            display: block;
            font-weight: bold;
            text-decoration: none;
            text-align: center;

            @if($mode == 'yinc_list' || $mode == 'ydisp_list')
                width: 80px;
                height: 63px;
                font-size: 10pt;
                border: dotted 1px #B3CA64;
                padding-left: 15px;
            @elseif($mode == 'yinc_detail' || $mode == 'ydisp_detail')
                width: 184px;
                height: 80px;
                background-size: contain;
                font-size: 12pt;
            @endif
        }
    </style>
</head>
<body>
    @if($mode == 'hinc' || $mode == 'hdisp')
        <div style="font-size:10px;">
        <a href="/hidoiine?mode=hinc&id={{$id}}" style="text-decoration:none;">
        <span style="margin: 0; border: 1px solid #ddd;border-radius: 5px;-webkit-border-radius: 5px;-moz-border-radius: 5px; "><img src="/img/unko.gif">
        ひどいいね! {{$hidoiine}}</span></a>
        </div>
    @elseif($mode == 'yinc_list' || $mode == 'ydisp_list' || $mode == 'yinc_detail' || $mode == 'ydisp_detail')
        <p class="nice_btn">
            <a href="/yattemitai?mode={{$mode}}&id={{$id}}">{{$yattemitai}}</a>
        </p>
    @endif
</body>
