<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pokemon Community</title>
@include('cssjs')
</head>
<body>
    <div class="login">
        <h1>パスワード再発行</h1>

        <form action="{{ url('reset_complete') }}" method="post">
        @csrf <!-- CSRF対策 -->
            <div class="inputbox">
                <input type="password" name="password" id="password" placeholder="新しいパスワード">
                <input type="hidden" name="email" id="email" value="<?php echo $email ?>">
                <input type="submit" name="send" id="send" value="送信">
            </div>  
        </form>
        <div class="new">
            <a href="{{ url('login') }}">ログイン画面へ戻る</a>
            <a href="{{ url('index') }}">トップに戻る</a>
        </div>
    </div>
</body>