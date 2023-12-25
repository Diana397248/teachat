<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this -> createCategory();
    }


    private function createCategory()
    {
        Category::create([
            "name" => "Музыка",
        ]);
        Category::create([
            "name" => "Спорт",
        ]);
        Category::create([
            "name" => "Рисование",
        ]);
        Category::create([
            "name" => "Мода",
        ]);
        Category::create([
            "name" => "Повседневная жизнь",
        ]);

    }
}


