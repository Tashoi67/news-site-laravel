<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();          // логин
            $table->string('password');                // хеш пароля
            $table->foreignId('role_id')               // внешний ключ на roles
                  ->constrained('roles')
                  ->restrictOnDelete();                // запрет удаления роли, если есть юзеры
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};