<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pokemon Community</title>
@include('cssjs')
</head>
<body>

    <div class="login">
        <h2>消去が完了しました。</h2>
        
    </div>
    <div class="new">
        <a href='{{ @$_SERVER["HTTP_REFERER"] }}'>戻る</a>
    </div>

</body>