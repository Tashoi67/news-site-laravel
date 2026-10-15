<header style="background:#222; color:#fff; padding:15px;">
    <div style="max-width:1200px; margin:0 auto; display:flex; justify-content:space-between; align-items:center;">
        <a href="/" style="color:#fff; font-size:22px; font-weight:bold; text-decoration:none;">📰 Новостной сайт</a>

        <nav style="display:flex; align-items:center; gap:15px;">
            <a href="/" style="color:#fff; text-decoration:none;">Главная</a>
            <a href="/category" style="color:#fff; text-decoration:none;">Категория</a>

            @auth
                @if(auth()->user()->isJournalist() || auth()->user()->isAdmin())
                    <a href="/journalist" style="color:#fff; text-decoration:none;">Журналист</a>
                @endif

                @if(auth()->user()->isAdmin())
                    <a href="/admin" style="color:#fff; text-decoration:none;">Админ</a>
                @endif

                <span style="color:#aaa;">{{ auth()->user()->name }} ({{ auth()->user()->role->name }})</span>

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:transparent; color:#fff; border:1px solid #fff; padding:5px 10px; border-radius:4px; cursor:pointer;">
                        Выйти
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" style="color:#fff; text-decoration:none;">Вход</a>
                <a href="{{ route('register') }}" style="color:#fff; text-decoration:none;">Регистрация</a>
            @endauth
        </nav>
    </div>
</header>