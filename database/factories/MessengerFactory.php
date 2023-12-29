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
        $randomChat = Chat::all()->random();
        $userId = $randomChat->chatUsers->random()->user->id;
        return [
            'chat_id' => $randomChat->id,
            'user_id' => $userId,
            'text_messenger' => $this->faker->text(12),
            'status' => 'read',
        ];
    }
}
