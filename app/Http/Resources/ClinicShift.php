<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClinicShift extends JsonResource
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
        	'clinic_id' => $this->clinic_id, 
	    	'start_shift' => $this->start_shift,
	    	'end_shift' => $this->end_shift,
	    	'active' => $this->active,
        ];
    }
}
