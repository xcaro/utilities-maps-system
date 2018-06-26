<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportType extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'confirmed_icon' => $this->confirmed_icon,
            'unconfirmed_icon' => $this->unconfirmed_icon,
            'menu_icon' => $this->menu_icon,
            'alive' => $this->alive,
        ];
    }
}
