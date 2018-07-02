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
    public function clinic()
    {
    	return $this->belongsTo(Clinic::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'shift_user', 'shift_id', 'user_id')->withPivot(['confirmed'])->withTimestamps();
    }
}
