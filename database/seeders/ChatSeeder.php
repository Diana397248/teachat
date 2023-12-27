<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    private static $keyUserId = "user_id";
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chat::factory()
            ->count(3)
            ->state(new Sequence(
                $this->createUserIdSecVal(1),
                $this->createUserIdSecVal(2),
                $this->createUserIdSecVal(3)))
            ->create();
    }
    private function createUserIdSecVal(int $id): array
    {
        return [ChatSeeder::$keyUserId => $id];
    }
}
