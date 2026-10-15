<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    protected $fillable = ['name', 'password', 'role_id'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',   // Laravel сам хеширует пароль
        ];
    }

    // Пользователь принадлежит одной роли
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    // У пользователя много статей
    public function texts(): HasMany
    {
        return $this->hasMany(Text::class);
    }

    // Хелпер: является ли пользователь админом
    public function isAdmin(): bool
    {
        return $this->role?->name === 'Администратор';
    }

    // Хелпер: является ли пользователь журналистом
    public function isJournalist(): bool
    {
        return $this->role?->name === 'Журналист';
    }
}