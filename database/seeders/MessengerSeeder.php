<?php

namespace Database\Seeders;

use App\Models\Messenger;
use Illuminate\Database\Seeder;

class MessengerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Messenger::factory()
            ->count(6)
            ->create();
    }
}
