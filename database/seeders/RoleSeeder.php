<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'Пользователь']);
        Role::create(['name' => 'Журналист']);
        Role::create(['name' => 'Администратор']);
    }
}