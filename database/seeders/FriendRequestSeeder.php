<?php

namespace Database\Seeders;

use App\Models\Friend;
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
        $alreadyFriendsId = Friend::all()->map(function (Friend $f) {
            return $f->user_id;
        });
        $randomsU = User::whereNotIn("id", $alreadyFriendsId)
            ->inRandomOrder()->limit(2)->get();
        if ($randomsU->count() >= 2) {
            FriendRequest::create([
                'user_id' => $randomsU->values()->get(0)->id,
                'friend_id' => $randomsU->values()->get(1)->id,
            ]);
        }
    }
}
