<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this -> createChat();
    }
    private function createChat()
    {
        Chat::factory()
            ->count(5)
            ->create();


    }
}
