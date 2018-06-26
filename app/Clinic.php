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
    	'active',
        'type',
    	'user_created',
        'ward_id',
        'district_id',
        'description',
    	'confirmed',
    	'active',
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
