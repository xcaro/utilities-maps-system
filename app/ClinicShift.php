<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicShift extends Model
{
    protected $fillable = [
    	'name',
    	'clinic_id',
    	'start_shift',
    	'end_shift',
    	'active',
    ];
    public function clinc()
    {
    	return $this->belongsTo(Clinic::class);
    }
}
