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
        <h2>ポケモントレード編集</h2>
        @foreach ($items as $item)
        <form action="{{ route('trade_update') }}" method="post">
        @csrf <!-- CSRF対策 -->
            <div class="inputbox">
                <input type="text" name="title" id="title" placeholder="タイトル" required value="{{ @$item->title }}">
            
                <input type="text" name="want" id="want" placeholder="欲しいポケモン" required value="{{ @$item->want }}">
            
                <input type="text" name="give" id="give" placeholder="出せるポケモン" required value="{{ @$item->give }}">

                <input type="text" name="vorsion" id="vorsion" placeholder="バージョン" required value="{{ @$item->vorsion }}">
            
                <input type="text" name="body" id="body" placeholder="一言コメント" required value="{{ @$item->body }}">
                <input type="hidden" name="id" value="{{ @$item->id }}">
                <input type="submit" name="send" id="send" value="編集完了">
                
            </div>  
        </form>
        @endforeach
        <a href="{{ url('/trade_list') }}">一覧画面へ戻る</a>
    </div>

    @include('footer')
</body>