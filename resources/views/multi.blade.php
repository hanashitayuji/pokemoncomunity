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
        <h2>マルチプレイ詳細</h2>
        @foreach ($items as $item)
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
            <li class="subtitle">内容</li>
            <li class="multi_main">{{ @$item->content }}</li>
        </ul>
        <ul>
            <li class="subtitle">あいことば</li>
            <li class="multi_main">{{ @$item->password }}</li>
        </ul>
        <ul>
            <li class="subtitle">バージョン</li>
            <li class="multi_main">{{ @$item->vorsion }}</li>
        </ul>
        @if($item->u_id == Auth::id())
        <ul>
            <li>
                <a href="/multi_update/{{ $item->id }}">編集</a>
                <a href="javascript:OnLinkClick2();">削除</a>
            </li>
        </ul>
        @endif
        @endforeach
        <form action="/multi_coment/{{ $item->id }}" method="post">
        @csrf <!-- CSRF対策 -->
            <div class="inputbox">
                <p>コメント</p>
                @foreach ($coments as $coment)
                <ul>
                    <li class="subtitle">
                        <a href="/user/{{ $coment->user_id }}">{{ @$coment->name }}</a>
                        @if($coment->coment_id!=null)
                        <p>➡︎</p>
                            @foreach ($users as $user)
                            <a href="/user/{{ $user->coment_id }}">{{ @$user->name }}</a>
                            @endforeach
                        @endif
                        <input type="checkbox" name=response value="{{ $coment->user_id }}"><p>返信する</p>
                        
                    </li>
                    <li class="multi_mains">
                        {{ @$coment->text }}
                        @if($coment->user_id == @Auth::id())
                        <a href="/multi_coment_delete/{{ $coment->id }}">削除</a>
                        @endif
                    </li>
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
        <a href="{{ url('/multi_list') }}">マルチ募集一覧へ</a>
    </div>
    
    @include('footer')
</body>
