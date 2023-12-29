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

}
