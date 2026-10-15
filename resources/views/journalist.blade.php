<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Журналист — Новостной сайт</title>
</head>
<body style="margin:0; font-family:Arial, sans-serif;">

    <x-header />

    <main style="max-width:700px; margin:30px auto; padding:0 15px;">
        <h1>Панель журналиста</h1>
        <p>Создание новой статьи.</p>

        @if ($errors->any())
            <div style="background:#f8d7da; color:#721c24; padding:15px; border-radius:5px; margin-bottom:20px;">
                @foreach ($errors->all() as $error)
                    <p style="margin:5px 0;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('texts.store') }}"
              style="display:flex; flex-direction:column; gap:15px;">
            @csrf

            <label>Заголовок статьи
                <input type="text" name="heading" value="{{ old('heading') }}" required
                       placeholder="Введите заголовок"
                       style="width:100%; padding:8px; margin-top:5px;">
            </label>

            <label>Категория
                <select name="category_id" required style="width:100%; padding:8px; margin-top:5px;">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </label>

            <label>Текст статьи
                <textarea name="text" rows="10" required placeholder="Введите текст статьи"
                          style="width:100%; padding:8px; margin-top:5px;">{{ old('text') }}</textarea>
            </label>

            <button type="submit"
                    style="padding:12px; background:#007bff; color:#fff; border:none; border-radius:5px; cursor:pointer;">
                Опубликовать
            </button>
        </form>
    </main>

    <x-footer />

</body>
</html>