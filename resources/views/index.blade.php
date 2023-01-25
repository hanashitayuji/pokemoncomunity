<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pokemon Community</title>
@include('cssjs')
</head>
<body>

    @include('header')
    
    <div class="top">
        <img src="./img/IMG_5178.jpg">
        <div class="item">
            <a class="menu" href="{{ url('/multi_list') }}">マルチプレイ</a>
            <a class="menu" href="{{ url('/trade_list') }}">ポケモントレード</a>
        </div>
    </div>




    @include('footer')
</body>