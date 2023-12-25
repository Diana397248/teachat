<?php

namespace Database\Seeders;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Database\Seeder;

class FriendRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $randomsU = User::inRandomOrder()->limit(2)->get();

        FriendRequest::create([
            'user_id' => $randomsU->values()->get(0)->id,
            'friend_id' => $randomsU->values()->get(1)->id,
        ]);
    }
}
