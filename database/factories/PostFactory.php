<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    private static $contentSrcDefault = 'https://opis-cdn.tinkoffjournal.ru/ip/gfbOp5Ri1xeqEVOjE8tbyc8s0sHkaPMbcQQ6UjM7coI/h:600/w:600/aHR0cHM6Ly9vcGlz/LWNkbi50aW5rb2Zm/am91cm5hbC5ydS9z/b2NpYWwvcHJvZmls/ZS9lY2Q3YThhMy4x/NGVpbDRpXzFwa3Qx/bl81NjR4NTY0LnBu/Zw';


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(12),
            'description' => $this->faker->text(20),
            'type' => $this->faker->randomElement(['img']),
            'content_src' => PostFactory::$contentSrcDefault,
            'user_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id,
        ];
    }
}
