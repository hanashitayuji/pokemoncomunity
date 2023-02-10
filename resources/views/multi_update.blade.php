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
        <h2>マルチプレイ編集</h2>
        @foreach ($items as $item)
        <form action="{{ route('multi_update') }}" method="post">
        @csrf <!-- CSRF対策 -->
            <div class="inputbox">
                <input type="text" name="title" id="title" placeholder="タイトル" required value="{{ @$item->title }}">
            
                <input type="text" name="content" id="content" placeholder="マルチプレイ内容" required value="{{ @$item->content }}">

                <input type="text" name="vorsion" id="vorsion" placeholder="バージョン" required value="{{ @$item->vorsion }}">
            
                <input type="text" name="password" id="password" placeholder="あいことば" required value="{{ @$item->password }}">

                <input type="hidden" name="id" value="{{ @$item->id }}">
                <input type="submit" name="send" id="send" value="編集完了">
            </div>  
        </form>
        @endforeach
        <a href="{{ url('/multi_list') }}">戻る</a>
    </div>

    @include('footer') 
</body>