<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Пользователи — Админ</title>
</head>
<body style="margin:0; font-family:Arial, sans-serif;">

    <x-header />

    <main style="max-width:1000px; margin:30px auto; padding:0 15px;">
        <h1>Управление пользователями</h1>

        @if(session('success'))
            <div style="background:#d4edda; color:#155724; padding:15px; border-radius:5px; margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        <p><a href="{{ route('admin') }}">← Назад в админку</a></p>

        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f0f0f0;">
                    <th style="border:1px solid #ddd; padding:10px;">ID</th>
                    <th style="border:1px solid #ddd; padding:10px;">Логин</th>
                    <th style="border:1px solid #ddd; padding:10px;">Текущая роль</th>
                    <th style="border:1px solid #ddd; padding:10px;">Изменить роль</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td style="border:1px solid #ddd; padding:10px;">{{ $user->id }}</td>
                        <td style="border:1px solid #ddd; padding:10px;">{{ $user->name }}</td>
                        <td style="border:1px solid #ddd; padding:10px;">{{ $user->role->name }}</td>
                        <td style="border:1px solid #ddd; padding:10px;">
                            <form method="POST" action="{{ route('admin.users.role', $user->id) }}" style="display:flex; gap:10px;">
                                @csrf
                                <select name="role_id" style="padding:5px;">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" style="background:#007bff; color:#fff; border:none; padding:5px 10px; cursor:pointer;">
                                    Сохранить
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

    <x-footer />

</body>
</html>