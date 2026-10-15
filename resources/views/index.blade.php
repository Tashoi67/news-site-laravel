<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная — Новостной сайт</title>
</head>
<body style="margin:0; font-family:Arial, sans-serif;">

    <x-header />

    <main style="max-width:1200px; margin:30px auto; padding:0 15px;">
        <h1>Все новости</h1>

        @if(session('success'))
            <div style="background:#d4edda; color:#155724; padding:15px; border-radius:5px; margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        @if($texts->isEmpty())
            <p style="color:#777;">Пока нет ни одной статьи. <a href="{{ route('journalist') }}">Создайте первую</a>.</p>
        @else
            <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:20px;">
                @foreach($texts as $text)
                    <article style="border:1px solid #ddd; padding:15px; border-radius:8px;">
                        <h3>{{ $text->heading }}</h3>
                        <p style="color:#666; font-size:14px;">
                            Категория: <strong>{{ $text->category->name }}</strong> ·
                            Автор: {{ $text->user->name }}
                        </p>
                        <p>{{ \Illuminate\Support\Str::limit($text->text, 120) }}</p>
                        <a href="#">Читать далее →</a>
                    </article>
                @endforeach
            </div>

            <div style="margin-top:30px;">
                {{ $texts->links() }}
            </div>
        @endif
    </main>

    <x-footer />

</body>
</html>