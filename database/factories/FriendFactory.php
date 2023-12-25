<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FriendFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomsU = User::inRandomOrder()->limit(2)->get();
        return [
            "user_id" => $randomsU->values()->get(0)-> id,
            "friend_user_id" => $randomsU->values()->get(1)-> id,
        ];
    }
}
