<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pokemon Community</title>
@include('cssjs')
</head>
<body>
@include('header')
    <div class="complete">
        <p>消去が完了しました。</p>
        
    </div>
    <div class="new">
        <a href='{{ @$_SERVER["HTTP_REFERER"] }}'>戻る</a>
    </div>
    @include('footer')
</body>