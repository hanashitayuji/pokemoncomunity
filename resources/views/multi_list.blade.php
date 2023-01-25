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
        <h2>マルチプレイ</h2>
        @foreach ($items as $item)
        <ul>
            <li class="multi_main"><a href="/multi/{{ $item->id }}">{{ @$item->title }}</a></li>
            <li class="multi_sub">{{ @$item->content }}</li>
        </ul>
        @endforeach
        <a href="{{ url('index') }}">トップへ戻る</a>
    </div>

    @include('footer')
</body>
