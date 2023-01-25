<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pokemon Community</title>
@include('cssjs')
</head>
<body>
        
    @include('header')
    <div class="multi">
        <h2>ポケモントレード</h2>
        @foreach ($items as $item) 
        <ul>
            <li class="trade_main"><a href="/trade/{{ $item->id }}">{{ @$item->title }}</a></li>
            <li class="trade_sub1">欲しいポケモン:{{ @$item->want }}</li>
            <li class="trade_sub2">欲しいポケモン:{{ @$item->give }}</li>
        </ul>
        @endforeach
        <a href="{{ url('index') }}">トップへ戻る</a>
    </div>




    @include('footer')
</body>
