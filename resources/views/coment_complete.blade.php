<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pokemon Community</title>
@include('cssjs')
</head>
<body>

    @include('header')
    <div class="login">
        <h2>コメントを送信しました。</h2>
        
    </div>
    <div class="new">

    
        <a href='{{ @$_SERVER["HTTP_REFERER"] }}'>投稿一覧に戻る</a>
    </div>

    @include('footer')
</body>