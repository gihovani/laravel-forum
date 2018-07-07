<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ThreadResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'id' => intval($this->id),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'user' => new UserResource($this->user),
            'user_id' => intval($this->user_id),
            'replies_count' => intval($this->replies_count),
            'fixed' => (bool) $this->fixed,
            'closed' => (bool) $this->closed,
        ];
    }
}
