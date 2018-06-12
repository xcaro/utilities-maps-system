<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Report extends JsonResource
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
            'id' => $this->id, 
            'latitude' => $this->latitude, 
            'longitude' => $this->longitude, 
            'comment' => $this->comment, 
            'type_id' => $this->type_id,
            'confirm' => $this->confirm,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
