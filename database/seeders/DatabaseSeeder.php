<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Сначала справочники
        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
        ]);

        // Создаём пользователей с ролями
        $adminRole      = Role::where('name', 'Администратор')->first();
        $journalistRole = Role::where('name', 'Журналист')->first();
        $userRole       = Role::where('name', 'Пользователь')->first();

        User::create([
            'name'     => 'admin',
            'password' => '123456',          // хешируется автоматически
            'role_id'  => $adminRole->id,
        ]);

        User::create([
            'name'     => 'journalist',
            'password' => '123456',
            'role_id'  => $journalistRole->id,
        ]);

        User::create([
            'name'     => 'user',
            'password' => '123456',
            'role_id'  => $userRole->id,
        ]);
    }
}