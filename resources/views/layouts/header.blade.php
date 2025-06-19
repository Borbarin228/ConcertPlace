<style>
.header-bar {
    width: 100%;
    height: 60px;
    background: #000;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
    font-family: 'Arial Rounded MT Bold', Arial, sans-serif;
    padding: 0 36px;
    box-sizing: border-box;
}
.header-logo {
    display: flex;
    align-items: center;
    font-size: 2.5rem;
    font-weight: bold;
    letter-spacing: -2px;
}
.header-logo-icon {
    width: 44px;
    height: 44px;
    background: #fff;
    color: #000;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.1rem;
    font-family: 'Arial Black', Arial, sans-serif;
    margin-right: 10px;
}
.header-center {
    flex: 1 1 auto;
    text-align: center;
    font-size: 1.7rem;
    font-weight: 500;
    letter-spacing: 1px;
}
.header-link {
    color: #fff;
    text-decoration: none;
    font-size: 1.35rem;
    font-weight: 400;
    margin-left: 30px;
    transition: color 0.2s;
}
.header-link:hover {
    color: #e74c3c;
}
@media (max-width: 600px) {
    .header-bar { padding: 0 10px; }
    .header-center { font-size: 1.1rem; }
    .header-link { font-size: 1rem; margin-left: 12px; }
    .header-logo-icon { width: 32px; height: 32px; font-size: 1.2rem; }
}
</style>
<div class="header-bar">
    <div class="header-logo">
        <a href="/" style="color:inherit; text-decoration:none; display:flex; align-items:center;">
            <span class="header-logo-icon">CE</span>
        </a>
    </div>
    <div class="header-center"><a href="{{ route('concerts.index') }}" style="color:inherit; text-decoration:none;">Афиша</a></div>
    <div>
        @auth
            <a href="{{ route('users.show', Auth::id()) }}" class="header-link">Профиль</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline; margin-left:10px;">
                @csrf
                <button type="submit" class="header-link" style="background:none; border:none; padding:0; cursor:pointer; color:#fff;">Выйти</button>
            </form>
            @if(Auth::user()->is_admin)
                <a href="{{ route('moderation.index') }}" class="header-link">Модерация</a>
                <a href="{{ route('moderation.concerts') }}" class="header-link">Мод. концерты</a>
                <a href="{{ route('users.index') }}" class="header-link">Мод. пользователи</a>
            @endif
        @endauth
        @guest
            <a href="{{ route('login') }}" class="header-link">Войти</a>
        @endguest
    </div>
</div> 