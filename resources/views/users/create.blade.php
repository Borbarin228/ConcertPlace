<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация | ConcertPlace</title>
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
            width: 100%;
        }
        .form-input, .form-textarea, .form-file {
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
        .form-input:focus, .form-textarea:focus {
            border: 3px solid #000;
        }
        .form-textarea {
            min-height: 80px;
            resize: vertical;
        }
        .form-file {
            padding: 10px 27px;
            font-size: 1.1rem;
        }
        .form-checkbox {
            width: auto;
            margin-right: 10px;
            transform: scale(1.5);
        }
        .form-label {
            font-size: 1.2rem;
            margin-bottom: 5px;
            align-self: flex-start;
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
            margin-bottom: 40px;
        }
        .form-btn:hover {
            background: #333;
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
        @media (max-width: 900px) {
            .container, .form-input, .form-textarea, .form-file, .error { width: 98vw; min-width: 0; max-width: 98vw; }
            .form-input, .form-textarea, .form-file, .error { font-size: 1.2rem; padding: 12px 10px; width: 95vw; }
            .form-btn { width: 95vw; font-size: 1.2rem; padding: 12px 0; }
            .form-title { font-size: 2.5rem; padding: 40px 0 30px 0; }
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
            <div class="form-title">РЕГИСТРАЦИЯ</div>
            @if ($errors->any())
                <div class="error">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" style="display: flex; flex-direction: column; align-items: center; width: 100%;">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-input" id="email" name="email" placeholder="Введите email" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-input" id="password" name="password" placeholder="Введите пароль" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
                    <input type="password" class="form-input" id="password_confirmation" name="password_confirmation" placeholder="Повторите пароль" required>
                </div>
                <div class="form-group">
                    <label for="name" class="form-label">Имя профиля</label>
                    <input type="text" class="form-input" id="name" name="name" placeholder="Имя профиля" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="description" class="form-label">Описание (необязательно)</label>
                    <textarea class="form-textarea" id="description" name="description" placeholder="О себе...">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="avatar" class="form-label">Аватар (необязательно)</label>
                    <input type="file" class="form-file" id="avatar" name="avatar" accept="image/*">
                </div>
                <button type="submit" class="form-btn">Зарегистрироваться</button>
            </form>
        </div>
    </div>
</body>
</html> 