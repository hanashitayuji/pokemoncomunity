<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pokemon Community</title>
@include('cssjs')
</head>
<body>
    <div class="login">
        <h1>新期登録</h1>
        <div class="inputbox">
            <form action="{{ route('register') }}" method="post">
                @csrf <!-- CSRF対策 -->
                <input type="text" name="name" id="name" placeholder="ユーザー名">
                <div class="error">@if ($errors->has('name')){{ $errors->first('name') }} @endif</div>
                <input type="text" name="email" id="email" placeholder="メールアドレス">
                <div class="error">@if ($errors->has('email')){{ $errors->first('email') }} @endif</div>
                <input type="password" name="password" id="password" placeholder="パスワード">
                <div class="error">@if ($errors->has('password')){{ $errors->first('password') }} @endif</div>
                <input type="text" name="body" id="body" placeholder="プロフィール一言コメント">
                
                <input type="submit" name="send" id="send" value="登録">
            </form>
        </div>  
        <div class="new">
            <a href="{{ url('login') }}">戻る</a>
        </div>
    </div>
</body>
