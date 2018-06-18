<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $fillable = [
    	'name',
    	'latitude',
    	'longitude',
    	'address',
    	'type',
    	'active',
    ];
    public function shifts()
    {
    	return $this->hasMany(ClinicShift::class, 'type');
    }
}
