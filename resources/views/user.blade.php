<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Pokemon Community</title>
@include('cssjs')
</head>
<body>

@include('header')
    <div class="member">
        <div class="icon">
            <img src="/img/IMG_5177.png">
        </div>
        @foreach ($items as $item)
        <div class="profile">
            
            <p>ユーザー名:　{{ @$item->name }}</p>
            <p>一言コメント</p>
            <p>{{ @$item->body }}</p>
            <div class="evaluate">
                @if(Auth::check())
                    
                    @if($good == 0)
                    <p class="good-counter">いいね数: {{ $count }}</p> 
                    <button onclick="like({{@$item->id}})">いいね<i id="good" class="far fa-heart"></i></button>
                    
                    @else
                    <p class="good-counter">いいね数: {{ $count }}</p>
                    <button onclick="like({{@$item->id}})">いいね<i id="good" class="fas fa-heart"></i></button>
                    
                    @endif               
                @else
                <p>いいね数: {{ $count }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="top">
        <p>ユーザー情報</p>
        <div class="recuruit">
            <h2><a href="{{ url('coment_list') }}">メッセージ一覧</a></h2>
            <h2><a href="{{ url('master_multi') }}">マルチ募集一覧</a></h2>
            <h2><a href="{{ url('master_trade') }}">交換募集一覧</a></h2>
        </div>
        @endforeach
        <div class="new">
            <a href="{{ url('index') }}">トップに戻る</a>
        </div>
    </div>
    @include('footer')
    <script type="text/javascript" src="{{ asset('/js/sub.js') }}"></script>
</body>