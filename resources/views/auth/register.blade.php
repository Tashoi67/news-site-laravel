<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация — Новостной сайт</title>
</head>
<body style="margin:0; font-family:Arial, sans-serif;">

    <x-header />

    <main style="max-width:500px; margin:40px auto; padding:0 15px;">
        <h1>Регистрация</h1>

        @if ($errors->any())
            <div style="background:#f8d7da; color:#721c24; padding:15px; border-radius:5px; margin-bottom:20px;">
                @foreach ($errors->all() as $error)
                    <p style="margin:5px 0;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" style="display:flex; flex-direction:column; gap:15px;">
            @csrf

            <label>Логин
                <input type="text" name="name" value="{{ old('name') }}" required
                       style="width:100%; padding:10px; margin-top:5px;">
            </label>

            <label>Пароль
                <input type="password" name="password" required
                       style="width:100%; padding:10px; margin-top:5px;">
            </label>

            <label>Подтверждение пароля
                <input type="password" name="password_confirmation" required
                       style="width:100%; padding:10px; margin-top:5px;">
            </label>

            <button type="submit"
                    style="padding:12px; background:#007bff; color:#fff; border:none; border-radius:5px; cursor:pointer;">
                Зарегистрироваться
            </button>
        </form>

        <p style="margin-top:20px;">Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a></p>
    </main>

    <x-footer />

</body>
</html>