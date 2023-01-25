<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pokemon Community　ログイン</title>
@include('cssjs')
</head>
<body>
    <div class="login">
        <h1>ログイン</h1>
        <div class="inputbox">
            @if (session('flash_message'))
            <div class="error">
                {{ session('flash_message') }}
            </div>
            @endif
            <form action="{{ route('login',['id'=>'$user->id']) }}" method="post">
                @csrf <!-- CSRF対策 -->
                <input type="text" name="email" id="email" placeholder="メールアドレス">
                
                <input type="password" name="password" id="password" placeholder="パスワード">

                <input type="submit" name="send" id="send" value="ログイン">
            </form> 
        </div>
        <div class="new">
            <a href="{{ url('register') }}">新規登録はこちら</a>
            <a href="{{ url('lose_password') }}">パスワードを忘れた方</a>
            <a href="{{ url('index') }}">トップに戻る</a>
        </div>  
    </div>
</body>