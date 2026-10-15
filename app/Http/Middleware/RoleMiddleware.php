<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Пускает дальше только пользователей с указанными ролями.
     * Использование: ->middleware('role:Администратор,Журналист')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Если не авторизован — на страницу входа
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Если роль пользователя не входит в список разрешённых
        $userRole = Auth::user()->role?->name;

        if (!in_array($userRole, $roles, true)) {
            abort(403, 'Доступ запрещён. У вас нет прав для этой страницы.');
        }

        return $next($request);
    }
}