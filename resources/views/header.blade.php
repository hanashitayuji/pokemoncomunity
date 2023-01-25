
<header>
        
    <h1>Pokemon<br>Community</h1>
    <div class="log">
        @if(Auth::check())
        <a href="{{ url('/master/@Auth::id()') }}">マイページへ</a>
    
        <a href="{{ url('/logout') }}">ログアウト</a>
    
        @else
        <a href="{{ url('/login') }}">ログイン</a>
        @endif
    </div>
</header>