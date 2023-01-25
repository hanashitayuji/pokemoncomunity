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
        <h2>ポケモントレード詳細</h2>
        @foreach ($items as $item)
        <script type="text/javascript">
            var id = '{{ @$item->id }}';
        </script>

        <ul>
        <li class="subtitle">投稿者</li>
            <li class="user">
                <a href="/user/{{ $item->u_id }}">{{ @$item->name }}</a>
            </li>
        </ul>
        <ul>
            <li class="subtitle">タイトル</li>
            <li class="multi_main">{{ @$item->title }}</li>
        </ul>
            
        <ul>
            <li class="subtitle">欲しいポケモン</li>
            <li>{{ @$item->want }}</li>
        </ul>
        <ul>
            <li class="subtitle">あげるポケモン</li>
            <li>{{ @$item->give }}</li>
        </ul>
        <ul>
            <li class="subtitle">バージョン</li>
            <li>{{ @$item->vorsion }}</li>
        </ul>
        <ul>
            <li class="subtitle">一言コメント</li>
            <li>{{ @$item->body }}</li>
        </ul>
        @if($item->u_id == Auth::id())
        <ul>
            <li>
                <a href="/trade_update/{{ $item->id }}">編集</a>
                <a href="javascript:OnLinkClick();">削除</a>
            </li>
        </ul>
        @endif
        @endforeach
        <form action="/trade_coment/{{ $item->id }}" method="post">
        @csrf <!-- CSRF対策 -->
            <div class="inputbox">
                <p>コメント</p>
                @foreach ($coments as $coment)
                <ul>
                    <li class="subtitle">
                        <a href="/user/{{ $coment->user_id }}">{{ @$coment->name }}➡︎</a>
                        @if($coment->coment_id!=null)
                        {{ @$coment->coment_id }}
                        @endif
                        <input type="checkbox" name=response value="{{ $coment->id }}"><p>返信する</p>
                        @if($coment->user_id == @Auth::id())
                        <a href="/trade_coment_delete/{{ $coment->id }}">削除</a>
                        @endif
                    </li>
                    <li class="multi_main">{{ @$coment->id }}.{{ @$coment->text }}</li>
                </ul>
                @endforeach
                @if(Auth::check())
                <input type="text" name="text" id="text" placeholder="コメント">
            
                <input type="submit" name="send" id="send" value="送る">
                @else
                <p>コメントをするには<a href="{{ url('/login') }}">ログイン</a>が必要です</p>
                @endif
            </div>  
        </form>
        
        <a href='{{ @$_SERVER["HTTP_REFERER"] }}'>戻る</a>
    </div>
    @include('footer')
</body>
