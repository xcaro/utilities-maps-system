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
        'end_date',
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
    public function userCreated()
    {
        return $this->belongsTo(User::class, 'user_created');
    }
    public function shifts()
    {
        return $this->hasMany(ClinicShift::class);
    }
    
}
