<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'id_user'=>$this->user->id,
            'user_name'=>$this->user->name,
            'id_category'=>$this->category->id,
            'category_name'=>$this->category-> name,
            'title'=>$this->title,
            'description'=>$this->description,
            'type'=>$this->type,
            'created_at'=>$this->created_at,
            'content_src'=>$this->content_src,
            'avatar_src'=>$this->user->avatar_src,
        ];
    }
}
