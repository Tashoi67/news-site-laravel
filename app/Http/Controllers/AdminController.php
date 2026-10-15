<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Text;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Главная страница админки — список статей
    public function index()
    {
        $texts = Text::with(['category', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin', compact('texts'));
    }

    // Удалить статью
    public function destroy($id)
    {
        Text::findOrFail($id)->delete();
        return back()->with('success', 'Статья удалена');
    }

    // Заблокировать / разблокировать
    public function toggleBlock($id)
    {
        $text = Text::findOrFail($id);
        $text->is_blocked = !$text->is_blocked;
        $text->save();

        $message = $text->is_blocked ? 'Статья заблокирована' : 'Статья разблокирована';
        return back()->with('success', $message);
    }

    // Список пользователей для смены ролей
    public function users()
    {
        $users = User::with('role')->orderBy('id')->get();
        $roles = Role::all();

        return view('admin-users', compact('users', 'roles'));
    }

    // Сменить роль пользователя
    public function changeRole(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->role_id = $request->role_id;
        $user->save();

        return back()->with('success', 'Роль пользователя изменена');
    }
}