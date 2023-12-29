<?php

namespace Database\Seeders;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Database\Seeder;

class FriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 4; $i++) {
            $this->createOneFriend();
        }
    }

    private function createOneFriend()
    {
        $randomsU = User::inRandomOrder()->limit(2)->get()->values();
        $u1 = $randomsU->get(0)->id;
        $u2 = $randomsU->get(1)->id;
        Friend::createFriend($u1, $u2);
    }
}
