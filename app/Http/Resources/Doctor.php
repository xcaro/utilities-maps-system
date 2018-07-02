<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Doctor extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'title' => $this->title,
            $this->mergeWhen(($this->image) != null, [
                'image' => url('upload/doctors/' . $this->image),
            ]),

        ];
    }
}
