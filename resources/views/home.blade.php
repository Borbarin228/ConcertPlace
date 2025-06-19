<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConcertPlace — Главная</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background: #fff;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: #fff;
        }
        .navbar {
            background: #000;
            color: #fff;
            display: flex;
            align-items: center;
            padding: 0 40px;
            height: 60px;
            justify-content: space-between;
        }
        .navbar .logo {
            font-size: 2.2rem;
            font-weight: bold;
            letter-spacing: 2px;
            background: #fff;
            color: #000;
            border-radius: 8px;
            padding: 2px 16px 2px 10px;
            margin-right: 10px;
        }
        .navbar .menu {
            display: flex;
            gap: 40px;
        }
        .navbar .menu a {
            color: #fff;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: 500;
            transition: color 0.2s;
        }
        .navbar .menu a:hover {
            color: #aaa;
        }
        .main-content {
            flex: 1 1 auto;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            min-height: calc(100vh - 60px - 60px);
            min-width: 0;
            position: relative;
            background: #fff;
            height: auto;
            padding-top: 60px;
            overflow-x: hidden;
        }
        .composition-wrap {
            width: 100%;
            margin-bottom: -4px;
            margin-top: 237px;
        }
        .hero-row {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            min-height: 50vh;
        }
        .hero-img {
            width: 600px;
            height: 720px;
            object-fit: cover;
            border-radius: 0;
            z-index: 1;
            min-width: 0;
            min-height: 0;
        }
        .red-square {
            position: absolute;
            background: rgba(255, 0, 0, 0.48);
            z-index: 2;
            pointer-events: none;
        }
        .red1 {
            position: absolute;
            left: -20%;
            top: 35%;
            width: 400px;
            height: 400px;
            transform: rotate(-18deg);
        }
        .red2 {
            position: absolute;
            right: -200px;
            bottom: -100px;
            width: 600px;
            height: 600px;
            transform: rotate(45deg);
        }
        .red-center {
            position:absolute;
            left: 50%;
            top: -450px;
            width: 450px;
            height: 450px;
            background: rgba(255, 0, 0, 0.48);
            z-index: 1;
            transform: translateX(-50%) rotate(-13deg);
        }
        .center-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 3;
            min-width: 200px;
            margin: 0 40px;
        }
        .main-btn {
            width: 360px;
            padding: 30px 0;
            background: #000;
            color: #fff;
            border: none;
            border-radius: 30px;
            font-size: 34px;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 10px;
            transition: background 0.2s;
        }
        .main-btn:hover {
            background: #333;
        }
        .register-link {
            margin-top: 8px;
            text-align: center;
            font-size: 20px;

        }
        .register-link a {
            color: #000;
            text-decoration: underline;
            font-weight: 500;
            transition: color 0.2s;

        }
        .register-link a:hover {
            color: #232323;
            font-weight: bold;
            text-shadow: rgba(10, 10, 10, 0.85) 0px 0px 3px;
        }
        .footer {
            background: #000;
            color: #fff;
            font-size: 1.5rem;
            padding: 15px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 3;
        }
        @media (max-width: 900px) {
            .footer { font-size: 1rem; padding: 10px 10px; }
            .hero-row { flex-direction: column; min-height: 0; max-width: 100vw; }
            .hero-img { width: 90vw; height: 180px; }
            .center-col { margin: 20px 0; }
            .red1, .red2 { display: none; }
        }
        /* --- О НАС --- */
        .about-section {
            background: #000;
            color: #fff;
            padding: 60px 0 40px 0;
            width: 100%;
            z-index: 3;
        }
        .about-title {
            text-align: center;
            color: #ff2222;
            font-size: 2.8rem;
            font-weight: bold;
            margin-bottom: 40px;
            letter-spacing: 2px;
        }
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 40px 40px;
            max-width: 1100px;
            margin: 0 auto;
        }
        .about-text {
            font-size: 1.15rem;
            line-height: 1.6;
            color: #fff;
        }
        .about-text strong, .about-text .red {
            color: #ff2222;
            font-weight: bold;
        }
        .about-img {
            width: 100%;
            max-width: 400px;
            border-radius: 8px;
            display: block;
            margin: 0 auto;
        }
        @media (max-width: 900px) {
            .about-grid {
                grid-template-columns: 1fr;
                grid-template-rows: auto;
            }
            .about-img { max-width: 90vw; }
        }
        .artist-section {
            background: #fff;
            color: #111;
            padding: 60px 0 40px 0;
            width: 100%;
            text-align: left;
        }
        .artist-title {
            text-align: center;
            color: #111;
            font-size: 2.8rem;
            font-weight: bold;
            margin-bottom: 40px;
            letter-spacing: 2px;
        }
        .artist-features {
            max-width: 700px;
            margin: 0 auto;
        }
        .artist-feature {
            display: flex;
            align-items: flex-start;
            gap: 24px;
            margin-bottom: 36px;
        }
        .artist-icon {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            margin-top: 4px;
        }
        .artist-feature-title {
            font-weight: bold;
            font-size: 1.15rem;
            margin-bottom: 2px;
        }
        .artist-link {
            display: block;
            text-align: center;
            font-size: 1.3rem;
            font-weight: bold;
            margin-top: 30px;
            color: #111;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    @include('layouts.header')
    <div class="composition-wrap">
        <div class="hero-row">
            <div style="position:relative;">
                <img src="{{ asset('storage/main1.png') }}" alt="Main 1" class="hero-img">
                <div class="red-square red1"></div>
            </div>
            <div class="red-center"></div>
            <div class="center-col">
                <form action="{{ route('login') }}" method="get">
                    <button type="submit" class="main-btn">Войти</button>
                </form>
                <div class="register-link">
                    <a href="{{ route('users.create') }}">Регистрация</a>
                </div>
            </div>
            <div style="position:relative;">
                <img src="{{ asset('storage/main2.png') }}" alt="Main 2" class="hero-img">
                <div class="red-square red2"></div>
            </div>
        </div>
    </div>
    <div class="about-section">
        <div class="about-title">О НАС</div>
        <div class="about-grid">
            <div class="about-text">
                <span class="red">МЫ — ПЛАТФОРМА</span>, разработанная для артистов и организаторов мероприятий, чтобы упростить процесс анонсирования концертов и управления событиями.<br>
                <span class="red">НАША ЦЕЛЬ</span> — создать удобное и эффективное пространство, где музыканты и исполнители могут легко делиться информацией о своих выступлениях и взаимодействовать с аудиторией.
            </div>
            <img src="{{ asset('storage/about1.png') }}" class="about-img" alt="Концерт 1">
            <img src="{{ asset('storage/about2.png') }}" class="about-img" alt="Концерт 2">
            <div class="about-text">
                <span class="red">МЫ СТРЕМИМСЯ ПОДДЕРЖИВАТЬ</span> артистов в продвижении их концертов, предоставляя удобные инструменты для планирования, анонсирования и продажи билетов. Мы верим в возможности для артистов, чтобы быть услышанными и видимыми, и хотим сделать процесс организации концертов максимально простым и доступным.
            </div>
            <div class="about-text">
                <span class="red">КОМАНДА СОСТОИТ ИЗ</span> экспертов в области музыки и технологий, которые понимают потребности артистов и организаторов мероприятий. Мы заботимся о том, чтобы помогать артистам достичь своих целей и сделать их концерты заметными и успешными.
            </div>
            <img src="{{ asset('storage/about3.png') }}" class="about-img" alt="Концерт 3">
        </div>
    </div>

    <div class="artist-section">
        <div class="artist-title">ЧТО МЫ ПРЕДЛАГАЕМ</div>
        <div class="artist-features">
            <div class="artist-feature">
                <img src="{{ asset('storage/artist1.png') }}" class="artist-icon" alt="calendar">
                <div>
                    <div class="artist-feature-title">Простая публикация мероприятий:</div>
                    Артисты могут без труда создавать и размещать информацию о своих концертах, в том числе дату, время, место и цены на билеты.
                </div>
            </div>
            <div class="artist-feature">
                <img src="{{ asset('storage/artist2.png') }}" class="artist-icon" alt="guitar">
                <div>
                    <div class="artist-feature-title">Личный профиль:</div>
                    Каждый артист имеет возможность создать свою страницу, где можно разместить биографию, фотографии, ссылки на социальные сети и предстоящие события.
                </div>
            </div>
            <div class="artist-feature">
                <img src="{{ asset('storage/artist3.png') }}" class="artist-icon" alt="ticket">
                <div>
                    <div class="artist-feature-title">Интеграция с продажей билетов:</div>
                    Мы предоставляем инструменты для продажи билетов прямо через платформу, упрощая процесс для пользователя.
                </div>
            </div>
            <div class="artist-feature">
                <img src="{{ asset('storage/artist4.png') }}" class="artist-icon" alt="feedback">
                <div>
                    <div class="artist-feature-title">Обратная связь:</div>
                    Фанаты могут оставлять отзывы и комментарии, создавая активное сообщество вокруг артистов.
                </div>
            </div>
        </div>
    </div>
</body>
@include('layouts.footer')
</html>
