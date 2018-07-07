<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'email' => $this->email,
            'id' => $this->id,
            'name' => $this->name,
            'photo_url' => $this->photo_url,
            'role' => $this->role,
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
