<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Maker;
use App\Models\News;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(100)->create();
        News::factory(100)->create();
        Maker::factory(100)->create();
        Product::factory(100)->create();
        Category::factory(100)->create();
        $this->call([
            UserSeeder::class,
        ]);
    }
}
