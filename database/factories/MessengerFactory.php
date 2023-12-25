<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessengerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'chat_id' => Chat::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'text_messenger' => $this->faker->text(12),
            'status' => $this->faker->randomElement(['sent', 'read']),
        ];
    }
}
