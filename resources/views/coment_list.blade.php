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
        <h2>送信メッセージ一覧</h2>
        @foreach ($items as $item)
        <ul>
            <li class="subtitle">
                @if($item->e_id == null)
                <a href="/multi/{{ $item->m_id }}">{{ $item->m_title }}</a>
                @else
                <a href="/trade/{{ $item->e_id }}">{{ $item->e_title }}</a>
                @endif    
            </li>
            <li class="multi_main">{{ @$item->id }}.{{ @$item->text }}</li>
        
        </ul>    
        @endforeach
        
        <a href='{{ @$_SERVER["HTTP_REFERER"] }}'>戻る</a>
        
    </div>
    @include('footer')
</body>