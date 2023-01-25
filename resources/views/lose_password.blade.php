<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pokemon Community</title>
@include('cssjs')
</head>
<body>
    <div class="login">
        <h1>パスワード再設定</h1>
        <form action="{{ route('reset') }}" method="post">
        @csrf <!-- CSRF対策 -->
            <div class="inputbox">
                <input type="text" name="email" id="email" placeholder="メールアドレス">
                    @if (session('flash_message'))
                    <div class="error">
                        {{ session('flash_message') }}
                    </div>
                    @endif
                <input type="submit" name="send" id="send" value="送信">
            </div>  
        </form>
        <div class="new">
            <a href="{{ url('login') }}">ログイン画面へ戻る</a>
            <a href="{{ url('index') }}">トップに戻る</a>
        </div>
    </div>
</body>