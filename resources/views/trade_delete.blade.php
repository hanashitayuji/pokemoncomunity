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
        <h2>消去が完了しました。</h2>
        
    </div>
    <div class="new">
        <a href="{{ url('/trade_list') }}">投稿一覧に戻る</a>
    </div>
    @include('footer')
</body>