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
        for ($i = 1; $i <= 10; $i++) {
            $this->createOneFriend();
        }
    }

    private function createOneFriend()
    {
        $randomsU = User::inRandomOrder()->limit(2)->get()->values();
        $u1 = $randomsU->get(0)->id;
        $u2 = $randomsU->get(1)->id;
        if (
            Friend::where('user_id', "=", $u1)->where('friend_user_id', "=", $u2)->exists()
            ||
            Friend::where('user_id', "=", $u2)->where('friend_user_id', "=", $u1)->exists()
        ) {
            return;
        }
        $friend = new Friend();
        $friend->user_id = $u1;
        $friend->friend_user_id = $u2;
        $friend->save();

        $friendReverse = new Friend();
        $friendReverse->user_id = $u2;
        $friendReverse->friend_user_id = $u1;
        $friendReverse->save();
    }
}
