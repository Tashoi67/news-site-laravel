<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Категория — Новостной сайт</title>
</head>
<body style="margin:0; font-family:Arial, sans-serif;">

    <x-header />

    <main style="max-width:1200px; margin:30px auto; padding:0 15px;">
        <h1>Категория: {{ $currentCategory->name }}</h1>

        <div style="margin-bottom:20px;">
            @foreach($categories as $cat)
                <a href="{{ route('category', $cat->id) }}"
                   style="margin-right:15px; padding:5px 12px; border:1px solid #007bff; border-radius:20px; text-decoration:none; color:#007bff; {{ $cat->id === $currentCategory->id ? 'background:#007bff; color:#fff;' : '' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        @if($texts->isEmpty())
            <p style="color:#777;">В этой категории пока нет статей.</p>
        @else
            @foreach($texts as $text)
                <article style="border-left:4px solid #007bff; padding:10px 15px; margin-bottom:20px;">
                    <h3>{{ $text->heading }}</h3>
                    <p style="color:#666; font-size:14px;">
                        Автор: {{ $text->user->name }} · {{ $text->created_at->format('d.m.Y') }}
                    </p>
                    <p>{{ \Illuminate\Support\Str::limit($text->text, 200) }}</p>
                    <a href="#">Читать далее →</a>
                </article>
            @endforeach

            <div style="margin-top:30px;">
                {{ $texts->links() }}
            </div>
        @endif
    </main>

    <x-footer />

</body>
</html>