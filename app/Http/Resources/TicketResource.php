<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'id' => $this->id,
            'uid' => $this->uid,
            'subject' => $this->subject,
            'user_name' => $this->user_name,
            'user_email' => $this->user_email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'messages' => MessageResource::collection($this->messages),
        ];
    }
}
