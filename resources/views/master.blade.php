<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pokemon Community</title>
@include('cssjs')
</head>
<body>

    @include('header')

    <div class="member">
        <div class="icon">
            <img src="/img/IMG_5177.png">
        </div>
        <div class="profile">
            <p>ユーザー名:　{{ Auth::user()->name }}</p>
            <p>一言コメント</p>
            <p>{{ Auth::user()->body }}</p>
            <div class="evaluate">
                <p>いいね数: {{ @$count }}</p>
            </div>
        </div>
    </div>
    <div class="top">
        <div class="item">
            <a class="menu" href="{{ url('trade_recuruit') }}">トレード募集をする</a>
            <a class="menu" href="{{ url('multi_recruit') }}">マルチ募集をする</a>
        </div>
        <p>ユーザー情報</p>
        <div class="recuruit">
            <h2><a href="/coment_list/{{ Auth::id() }}">メッセージ一覧</a></h2>
            <h2><a href="/master_multi/{{ Auth::id() }}">マルチ募集一覧</a></h2>
            <h2><a href="/master_trade/{{ Auth::id() }}">交換募集一覧</a></h2>
        </div>
        <div class="new">
            <a href="{{ url('index') }}">トップに戻る</a>
        </div>
    </div>
    

    
    @include('footer')
</body>