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
        <h2>投稿が完了しました。</h2>
        
    </div>
    <div class="new">
        <a href="{{ url('/master/@Auth::id()') }}">会員画面に戻る</a>
    </div>

    @include('footer')
</body>