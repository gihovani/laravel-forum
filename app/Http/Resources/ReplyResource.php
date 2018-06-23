<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'body' => $this->body,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'id' => intval($this->id),
            'thread_id' => intval($this->thread_id),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'user' => $this->user,
            'user_id' => intval($this->user_id),
            'highlighted' => (bool) $this->highlighted
        ];
    }
}
