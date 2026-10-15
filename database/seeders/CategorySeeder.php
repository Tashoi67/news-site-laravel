<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Наука']);
        Category::create(['name' => 'Технологии']);
        Category::create(['name' => 'Медицина']);
        Category::create(['name' => 'Космос']);
    }
}