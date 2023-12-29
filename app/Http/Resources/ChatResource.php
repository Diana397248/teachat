<?php

namespace App\Http\Resources;

use App\Models\Chat;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $user = auth('sanctum')->user();
        $findChat = Chat::find($this->id);
        $uId = $findChat->chatOtherUser($user)->id;
        $uName = $findChat->chatOtherUser($user)->name;
        $uAvatar = $findChat->chatOtherUser($user)->avatar_src;
        return [
            'id' => $this->id,
            'user_id' => $uId,
            'user_name' => $uName,
            'avatar_src' => $uAvatar,
        ];
    }
}
