<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TextController extends Controller
{
    // Главная — все незаблокированные статьи, свежие сверху, с пагинацией
    public function index()
    {
        $texts = Text::with(['category', 'user'])
            ->where('is_blocked', false)
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('index', compact('texts'));
    }

    // Статьи одной категории
    public function category($id = null)
    {
        $categories = Category::all();

        // Если id не передан — берём первую категорию
        if (!$id) {
            $id = $categories->first()?->id;
        }

        $currentCategory = Category::findOrFail($id);

        $texts = Text::with(['category', 'user'])
            ->where('is_blocked', false)
            ->where('category_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('category', compact('texts', 'categories', 'currentCategory'));
    }

    // Форма создания статьи (только журналист/админ)
    public function create()
    {
        $categories = Category::all();
        return view('journalist', compact('categories'));
    }

    // Сохранение статьи
    public function store(Request $request)
    {
        $data = $request->validate([
            'heading'     => 'required|string|min:3|max:255',
            'category_id' => 'required|exists:categories,id',
            'text'        => 'required|string|min:10',
        ], [
            'heading.required'     => 'Введите заголовок',
            'heading.min'          => 'Заголовок минимум 3 символа',
            'category_id.required' => 'Выберите категорию',
            'category_id.exists'   => 'Такой категории не существует',
            'text.required'        => 'Введите текст статьи',
            'text.min'             => 'Текст минимум 10 символов',
        ]);

        Text::create([
            'heading'     => $data['heading'],
            'text'        => $data['text'],
            'category_id' => $data['category_id'],
            'user_id'     => Auth::id(),
            'is_blocked'  => false,
        ]);

        return redirect()->route('home')->with('success', 'Статья успешно опубликована!');
    }
}