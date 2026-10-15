<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('texts', function (Blueprint $table) {
            $table->id();
            $table->string('heading');                  // заголовок статьи
            $table->text('text');                       // полный текст
            $table->foreignId('category_id')            // категория
                  ->constrained('categories')
                  ->restrictOnDelete();                 // запрет удаления категории, если есть статьи
            $table->foreignId('user_id')                // автор
                  ->constrained('users')
                  ->cascadeOnDelete();                  // при удалении юзера его статьи удаляются
            $table->boolean('is_blocked')->default(false); // для админки (блокировка)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('texts');
    }
};