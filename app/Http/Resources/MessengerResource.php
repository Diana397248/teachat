<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessengerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'chat_id' => $this->chat_id,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'text_messenger' => $this->text_messenger,
            'created_at' => $this->created_at,
            'status' => $this->status,
        ];
    }
}
