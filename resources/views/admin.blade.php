<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ — Новостной сайт</title>
</head>
<body style="margin:0; font-family:Arial, sans-serif;">

    <x-header />

    <main style="max-width:1200px; margin:30px auto; padding:0 15px;">
        <h1>Панель администратора</h1>

        @if(session('success'))
            <div style="background:#d4edda; color:#155724; padding:15px; border-radius:5px; margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        <p>
            <a href="{{ route('admin.users') }}" style="padding:8px 16px; background:#007bff; color:#fff; text-decoration:none; border-radius:4px;">
                Управление пользователями
            </a>
        </p>

        <h2>Управление статьями</h2>

        @if($texts->isEmpty())
            <p style="color:#777;">Статей нет.</p>
        @else
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:#f0f0f0;">
                        <th style="border:1px solid #ddd; padding:10px;">ID</th>
                        <th style="border:1px solid #ddd; padding:10px;">Заголовок</th>
                        <th style="border:1px solid #ddd; padding:10px;">Категория</th>
                        <th style="border:1px solid #ddd; padding:10px;">Автор</th>
                        <th style="border:1px solid #ddd; padding:10px;">Статус</th>
                        <th style="border:1px solid #ddd; padding:10px;">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($texts as $text)
                        <tr>
                            <td style="border:1px solid #ddd; padding:10px;">{{ $text->id }}</td>
                            <td style="border:1px solid #ddd; padding:10px;">{{ $text->heading }}</td>
                            <td style="border:1px solid #ddd; padding:10px;">{{ $text->category->name }}</td>
                            <td style="border:1px solid #ddd; padding:10px;">{{ $text->user->name }}</td>
                            <td style="border:1px solid #ddd; padding:10px;">
                                @if($text->is_blocked)
                                    <span style="color:#dc3545;">Заблокирована</span>
                                @else
                                    <span style="color:#28a745;">Активна</span>
                                @endif
                            </td>
                            <td style="border:1px solid #ddd; padding:10px;">
                                <form method="POST" action="{{ route('admin.texts.toggle-block', $text->id) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" style="background:#ffc107; border:none; padding:5px 10px; cursor:pointer;">
                                        {{ $text->is_blocked ? 'Разблокировать' : 'Блокировать' }}
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('admin.texts.destroy', $text->id) }}" style="display:inline;" onsubmit="return confirm('Удалить статью?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:#dc3545; color:#fff; border:none; padding:5px 10px; cursor:pointer;">
                                        Удалить
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </main>

    <x-footer />

</body>
</html>