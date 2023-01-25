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
        <h2>ポケモントレード</h2>
        <form action="{{ url('recuruit_complete') }}" method="post">
        @csrf <!-- CSRF対策 -->
            <div class="inputbox">
                <input type="text" name="title" id="title" placeholder="タイトル">
                <div class="error">@if ($errors->has('title')){{ $errors->first('title') }} @endif</div>
                <input type="text" name="want" id="want" placeholder="欲しいポケモン">
                <div class="error">@if ($errors->has('want')){{ $errors->first('want') }} @endif</div>
                <input type="text" name="give" id="give" placeholder="出せるポケモン">
                <div class="error">@if ($errors->has('give')){{ $errors->first('give') }} @endif</div>
                <input type="text" name="vorsion" id="vorsion" placeholder="バージョン">
                
                <input type="text" name="body" id="body" placeholder="一言コメント">
                <div class="error">@if ($errors->has('body')){{ $errors->first('body') }} @endif</div>
                <input type="submit" name="send" id="send" value="登録">
            </form>  
        </div>
        <a href="{{ url('/master/@Auth::id()') }}">戻る</a>
    </div>

    @include('footer')
</body>