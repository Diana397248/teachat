<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Friend extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function friend()
    {
        return $this->belongsTo(User::class, 'friend_user_id');
    }

    public function getChatId()
    {
        $map = array();

        $findChatsUsers = ChatUsers::whereIn(
            'user_id',
            collect([$this->user->id, $this->friend->id])
        )->get();
        foreach ($findChatsUsers as $fcu){
            $chatIdString = "" . ($fcu->chat_id);
            if (array_key_exists($chatIdString, $map)) {
                return $fcu->chat_id;
            }
            $map[$chatIdString] = $fcu->user_id;
        }
        abort(404);
    }
}
