<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\ChatUsers;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        $allUsersQuery = User::inRandomOrder();
        $countAllUser = $allUsersQuery->get()->count();
        $allUsersQuery->get()->each(function (User $curUser) use ($allUsersQuery, $countAllUser) {
            $usersForChats = $allUsersQuery->limit(rand(1, $countAllUser))
                ->get()
                ->except($curUser->id);
            $this->createChatsForUser($usersForChats, $curUser);
        });
    }

    private function createChatsForUser(Collection $usersForChats, User $current)
    {
        $usersForChats->each(function (User $friendUser) use ($current) {
            // break if exist
            $curIds = collect([$current->id, $friendUser->id]);
            foreach (Chat::all() as $c) {
                $chatUsers = $c->chatUsers;
                $findUserIdsInChat = $chatUsers->map(function ($e) {
                    return $e->user_id;
                });
                if ($findUserIdsInChat->diff($curIds)->isEmpty()) {
                    return;
                }
            }

            Chat::createUserChat($current->id, $friendUser->id);
        });
    }
}
