<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pokemon Community</title>
@include('cssjs')
</head>
<body>

    @include('header')
    <div class="multi">
        <h2>マルチプレイ</h2>
        <form action="{{ url('recruit_complete') }}" method="post">
        @csrf <!-- CSRF対策 -->
            <div class="inputbox">
                <input type="text" name="title" id="title" placeholder="タイトル">
                <div class="error">@if ($errors->has('title')){{ $errors->first('title') }} @endif</div>
                <input type="text" name="content" id="content" placeholder="マルチプレイ内容">
                <div class="error">@if ($errors->has('content')){{ $errors->first('content') }} @endif</div>
                <input type="text" name="vorsion" id="vorsion" placeholder="バージョン">
                
                <input type="text" name="password" id="password" placeholder="あいことば">
                <div class="error">@if ($errors->has('password')){{ $errors->first('password') }} @endif</div>
                <input type="submit" name="send" id="send" value="登録">
            </div>  
        </form>
        <a href="{{ url('/master/@Auth::id()') }}">戻る</a>
    </div>

    @include('footer')
</body>