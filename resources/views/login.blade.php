<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход | ConcertPlace</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background: #fff;
            font-family: Arial, sans-serif;
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
            margin-right: 30px;
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
        .center-wrap {
            flex: 1 1 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
        }
        .container {
            background: #fff;
            width: 100%;
            max-width: 720px;
            margin: 0 auto;
            box-shadow: none;
            padding: 0 0 60px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-title {
            text-align: center;
            font-size: 3.75rem;
            font-weight: 600;
            margin: 0;
            letter-spacing: 2px;
            padding: 60px 0 45px 0;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }
        .form-input {
            width: 525px;
            padding: 18px 27px;
            font-size: 1.65rem;
            border: 2.25px solid #222;
            border-radius: 30px;
            margin-bottom: 15px;
            outline: none;
            background: #fff;
            color: #222;
            transition: border 0.2s;
        }
        .form-input:focus {
            border: 3px solid #000;
        }
        .form-btn {
            width: 300px;
            padding: 18px 0;
            background: #000;
            color: #fff;
            border: none;
            border-radius: 30px;
            font-size: 1.8rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 15px;
            transition: background 0.2s;
        }
        .form-btn:hover {
            background: #333;
        }
        .register-link {
            margin-top: 30px;
            text-align: center;
            font-size: 1.2rem;
        }
        .register-link a {
            color: #000;
            text-decoration: underline;
            font-weight: 500;
            transition: color 0.2s;
        }
        .register-link a:hover {
            color: #007bff;
        }
        .error {
            color: #b00;
            background: #fbeaea;
            border: 1.5px solid #b00;
            border-radius: 12px;
            padding: 15px 30px;
            margin: 0 auto 30px auto;
            width: 525px;
            text-align: center;
            font-size: 1.1rem;
        }
        .footer {
            background: #000;
            color: #fff;
            font-size: 1.5rem;
            padding: 15px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
        }
        @media (max-width: 900px) {
            .container, .form-input, .error { width: 98vw; min-width: 0; max-width: 98vw; }
            .form-input, .error { font-size: 1.2rem; padding: 12px 10px; width: 95vw; }
            .form-btn { width: 95vw; font-size: 1.2rem; padding: 12px 0; }
            .form-title { font-size: 2.5rem; padding: 40px 0 30px 0; }
            .footer { font-size: 1rem; padding: 10px 10px; }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="/" style="text-decoration:none;"><span class="logo">C</span></a>
        <div class="menu">
            <a href="#">Клиентам</a>
            <a href="#">Артистам</a>
            <a href="#">О нас</a>
        </div>
    </div>
    <div class="center-wrap">
        <div class="container">
            <div class="form-title">ВХОД</div>
            @if ($errors->any())
                <div class="error">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('login.authenticate') }}" style="display: flex; flex-direction: column; align-items: center;">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-input" name="email" placeholder="Введите логин" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-group">
                    <input type="password" class="form-input" name="password" placeholder="Введите пароль" required>
                </div>
                <button type="submit" class="form-btn">Войти</button>
            </form>
            <div class="register-link">
                Нет аккаунта? <a href="{{ route('users.create') }}">Зарегистрироваться</a>
            </div>
        </div>
    </div>
    <div class="footer">
        <span>©ConcertPlace</span>
        <span>ConcertPlaceModer@gmail.com</span>
    </div>
</body>
</html> 