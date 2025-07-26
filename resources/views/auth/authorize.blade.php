<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Авторизация</title>

    <!-- Подключение шрифта -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Подключение Bootstrap CSS -->
    <link href="{{ asset('source/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .wrapper {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 700;
            color: #333;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .form-footer {
            text-align: center;
            margin-top: 15px;
        }

        .underlineHover {
            color: #007bff;
            text-decoration: none;
        }

        .underlineHover:hover {
            text-decoration: underline;
        }

        .alert-danger {
            margin-bottom: 20px;
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body class="antialiased">

    <div class="wrapper">
        <h2>Войти в систему</h2>

        <!-- Вывод ошибок -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Форма входа -->
        <form action="{{ url('/auth') }}" method="post">
            @csrf
            <input type="email" id="login" name="email" placeholder="Логин" value="{{ old('email') }}" required>
            <input type="password" id="password" name="password" placeholder="Пароль" required>
            <input type="submit" value="ВОЙТИ">
        </form>

        <!-- Ссылка на регистрацию -->
        <div class="form-footer">
            <a href="{{ route('register.form') }}" class="underlineHover">Зарегистрироваться</a>
        </div>
    </div>

</body>
</html>
