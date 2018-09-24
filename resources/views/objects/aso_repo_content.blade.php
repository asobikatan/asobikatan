<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body{
            width: 100%;
            margin: 0;
        }
    </style>
</head>
<body>
    <img src="/img/aso_repo/{{$aso_repo->id}}_700.jpg" style="width: 100%">
    <p>{!!nl2br($aso_repo->content)!!}</p>
</body>
