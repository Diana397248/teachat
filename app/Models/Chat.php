<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;


    public function chatUsers()
    {
        return $this->hasMany(ChatUsers::class);
    }

    public function chatOtherUser(User $user)
    {
        $curUsers = $this->chatUsers;
        return $curUsers->where('user_id', "!=", $user->id)->first()->user;
    }

    public static function createUserChat($currentId, $friendUserId)
    {
        $newChat = new Chat();
        $newChat->save();

        // it`s me
        $chatUserCur = new ChatUsers();
        $chatUserCur->user_id = $currentId;
        $chatUserCur->chat_id = $newChat->id;
        $chatUserCur->save();
        // My friend
        $chatUserFriend = new ChatUsers();
        $chatUserFriend->user_id = $friendUserId;
        $chatUserFriend->chat_id = $newChat->id;
        $chatUserFriend->save();
    }
}
