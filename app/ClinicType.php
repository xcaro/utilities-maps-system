<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicType extends Model
{
    protected $fillable = [
    	'name', 'active',
    ];
    public function clinics()
    {
    	return $this->hasMany(Clinic::class, 'type_id');
    }
}
