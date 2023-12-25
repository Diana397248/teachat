<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //TODO вылазит ошибка при миграции сидера
        User::factory(3)->create();
        DatabaseSeeder:
        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
            ChatSeeder::class,
            MessengerSeeder::class,
            FriendSeeder::class,
            FriendRequestSeeder::class,
        ]);
    }
}
