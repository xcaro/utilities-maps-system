<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTurn extends Model
{
    protected $fillable = [
    	'user_id', 'confirm', 'register_day', 'description',
    ];
    public function shifts()
    {
    	return $this->belongsToMany(ClinicShift::class, 'shift_turn', 'turn_id', 'shift_id')->withPivot('confirmed');;
    }
}
