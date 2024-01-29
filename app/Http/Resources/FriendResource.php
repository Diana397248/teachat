<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FriendResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $chatId = $this->getChatId();
        $res = [
            'id' => $this->id,
            'user_id' => $this->friend->id,
            'user_name' => $this->friend->name,
            'avatar_src' => $this->friend->avatar_src,
        ];
        if ($chatId['ok']) {
            $res['chat_id'] = $chatId['chatId'];
        }
        return $res;
    }
}
